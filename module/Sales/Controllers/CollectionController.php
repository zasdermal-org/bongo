<?php

namespace Module\Sales\Controllers;

use App\Http\Controllers\Controller;


use App\Models\Depot;
use App\Models\DepotStockProduct;
use App\Models\Order;
use App\Models\ReturnTrack;
use App\Models\Transection;

use App\Imports\CollectionsImport;

use App\Models\User;
use App\Models\WarehouseStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use App\Services\DailyStockService;
use Illuminate\Support\Carbon;


use Module\Market\Models\SalePoint;
use Module\Sales\Models\Collection;
use Module\Sales\Models\OrderInvoice;

class CollectionController extends Controller
{
    public function dues(Request $request)
    {
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Collection', 'url' => null],
            ['title' => 'Dues', 'url' => null]
        ];

        $data['salePoints'] = SalePoint::all();

        $query = OrderInvoice::query();
        $queryTwo = OrderInvoice::query();
        $sale_point_id = $request->sale_point_id;

        $fromDate = $request->filled('from_date') && Carbon::hasFormat($request->from_date, 'Y-m-d')
            ? Carbon::parse($request->from_date)->startOfDay()
            : null;

        $toDate = $request->filled('to_date') && Carbon::hasFormat($request->to_date, 'Y-m-d')
            ? Carbon::parse($request->to_date)->endOfDay()
            : null;

        if ($request->payment_type && $request->payment_type !== 'all') {
            $query->where('payment_type', $request->payment_type);
        }

        $data['orderInvoices'] = $query->where('sale_point_id', $sale_point_id)
            ->whereNotIn('status', ['Requested', 'Cancel'])
            ->whereIn('payment_status', ['Due', 'Partial Paid'])
            ->get();

        foreach ($data['orderInvoices'] as $invoice) {
            $invoice->discount_value = ($invoice->total_amount * $invoice->discount) / 100;
        }

        //for sale point total calculation of a given date range

        if ($fromDate && $toDate) {
            $queryTwo->where('sale_point_id', $sale_point_id)->whereBetween('invoice_date', [$fromDate, $toDate]);
            $total_query = $queryTwo->get();

            // $total_discount = 0;
            // foreach ($total_query as $invoice) {
            //     $total_discount += ($invoice->total_amount * $invoice->discount) / 100;
            // }

            $total_discount = $total_query->sum(function ($invoice) {
                return ($invoice->total_amount * $invoice->discount) / 100;
            });

            // $data['invoice'] = $total_query->count();
            $data['invoice_value'] = $total_query->sum('total_amount');
            $data['discount_value'] = $total_discount;
            // $data['return_value'] = $total_query->sum('return_amount');
            $data['payable_value'] = $data['invoice_value'] - $data['discount_value'];
            $data['paid'] = $total_query->sum('paid');
            $data['adjustment'] = $total_query->sum('addi_discount');
            $data['due'] = $total_query->sum('due');
        }

        return view('Sales::collection.dues', $data);
    }

    public function updateDue(Request $request)
    {
        $request->validate([
            'selected_invoices'   => 'required|array',
            'selected_invoices.*' => 'exists:order_invoices,id',
            'addi_discount'       => 'nullable|numeric|min:0',
            'total_collect'       => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $totalCollect  = $request->total_collect;
            $extraDiscount = $request->addi_discount ?? 0;

            // Get invoices in the same order as selected
            $invoices = OrderInvoice::whereIn('id', $request->selected_invoices)
                ->orderBy('id') // or invoice_date if that's your order
                ->get();

            // --- STEP 1: apply payments FIFO (front to back)
            foreach ($invoices as $invoice) {
                if ($totalCollect > 0) {
                    $dueBefore = $invoice->due;
                    $payNow    = min($totalCollect, $dueBefore);

                    $invoice->paid = ($invoice->paid ?? 0) + $payNow;
                    $invoice->due  = $dueBefore - $payNow;

                    $totalCollect -= $payNow;
                }
            }

            // --- STEP 2: apply extra discount LIFO (back to front)
            if ($extraDiscount > 0) {
                foreach ($invoices->reverse() as $invoice) {
                    if ($extraDiscount <= 0) break;

                    $dueBefore = $invoice->due;
                    $discountNow = min($extraDiscount, $dueBefore);

                    $invoice->addi_discount = ($invoice->addi_discount ?? 0) + $discountNow;
                    $invoice->due = $dueBefore - $discountNow;

                    $extraDiscount -= $discountNow;
                }
            }

            // --- STEP 3: update statuses
            foreach ($invoices as $invoice) {
                if ($invoice->due <= 0) {
                    $invoice->payment_status = 'Paid';
                } elseif ($invoice->paid > 0 && $invoice->due > 0) {
                    $invoice->payment_status = 'Partial Paid';
                } else {
                    $invoice->payment_status = 'Due';
                }

                $invoice->save();
            }

            $invoiceNumbers = $invoices->pluck('invoice_number')->implode(', ');

            Collection::create([
                'user_id'        => auth()->user()->id,
                'sale_point_id'  => $invoices->first()->sale_point_id ?? null, // taking from first invoice
                'invoice_numbers'=> $invoiceNumbers,
                'total_collect'  => $request->total_collect,
                // 'payment_type'   => $request->payment_type,
                // 'tracking_number'=> $request->tracking_number ?? null,
            ]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Payment has been updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Failed to update payment: ' . $e->getMessage());
        }
    }


    public function due($id)
    {
        $collection = Collection::with(
            'orderInvoice.salePoint',
            'orderInvoice.user',
            'orderInvoice.orders'
        )->find($id);
        
        $total_partial_paid = Collection::where('order_invoice_id', $collection->order_invoice_id)
            ->where('status', 'Partial | Paid')
            ->sum('partial_paid');

        $total_addi_dis_amount = Collection::where('order_invoice_id', $collection->order_invoice_id)
            ->where('status', 'Partial | Paid')
            ->sum('addi_dis_amount');

        $total_return_amount = Collection::where('order_invoice_id', $collection->order_invoice_id)
            ->sum('return_amount');

        return response()->json([
            'collection' => $collection,
            'total_partial_paid' => $total_partial_paid,
            'total_addi_dis_amount' => $total_addi_dis_amount,
            'total_return_amount' => $total_return_amount,
        ]);
    }

    public function update_copy(Request $request)
    {
        // dd($request->all());
        $userId = Auth::user()->id;

        foreach ($request->collections as $collectionData) {
             $collection = Collection::findOrFail($collectionData['collection_id']);

             if ($collection) {
                $due_amount = $collection->collection_amount - $collectionData['discount_amount'] - $collectionData['paid_amount'];
                // dd($due_amount);

                if ($due_amount > 0) {
                    $collection->update([
                        'user_id' => $userId,
                        'status' => 'Partial | Paid',
                        'addi_dis_amount' => $collectionData['discount_amount'],
                        'partial_paid' => $collectionData['paid_amount'],
                        'due' => $due_amount
                    ]);
    
                    Collection::create([
                        'order_invoice_id' => $collection->order_invoice_id,
                        'status' => 'Partial Payment',
                        'collection_amount' => $due_amount,
                        'due' => $due_amount,
                    ]);
                } else {
                    $collection->update([
                        'user_id' => $userId,
                        'status' => 'Paid',
                        'addi_dis_amount' => $collectionData['discount_amount'],
                        'full_paid' => $collectionData['collection_amount'],
                        'due' => 0.00
                    ]);
                }
            }
        }

        return redirect()->back();
    }









    public function partial_dues(Request $request)
    {
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Collections Report', 'url' => null],
            ['title' => 'Partial Dues', 'url' => null]
        ];
        $data['partial_payment'] = Collection::where('status', 'Partial Payment')->get();

        return view('collections_report.partial_dues', $data);
    }

    public function update(Request $request, $id)
    {
        $auth_user = Auth::user()->id;

        $data = $request->validate([
            'ait' => 'nullable|numeric',
            'additional_discount' => 'nullable|numeric',
            'collected_payment' => 'nullable|numeric',
        ]);

        $ait = $data['ait'] ?? null;
        $additional_discount = $data['additional_discount'] ?? null;

        // $total_payment = $data['additional_discount'] + $data['collected_payment'];

        // return response()->json([
        //     'total_payment' => $total_payment
        // ]);

        // dd($total_payment);

        $collection = Collection::findOrFail($id);
        
        if ($ait || $additional_discount) {

            $due_amount = $collection->collection_amount - $collection->return_amount - $ait - $additional_discount;

            $collection->update([
                'ait' => $ait ?? null,
                'addi_dis_amount' => $additional_discount ?? null,
                'due' => $due_amount
            ]);

            if ($collection->status === 'Due') {
                if ($data['collected_payment'] == $collection->due) {
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Paid',
                        'full_paid' => $due_amount,
                        'due' => 0.00
                    ]);
                } else {
                    $rest_amount = $collection->collection_amount - $collection->ait - $collection->addi_dis_amount - $collection->return_amount - $data['collected_payment'];
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Partial | Paid',
                        'partial_paid' => $data['collected_payment'],
                        'due' => $rest_amount
                    ]);
    
                    Collection::create([
                        'order_invoice_id' => $collection->order_invoice_id,
                        'status' => 'Partial Payment',
                        'collection_amount' => $rest_amount,
                        'due' => $rest_amount,
                    ]);
                }
            }

            if ($collection->status === 'Partial Payment') {
                if ($data['collected_payment'] == $collection->due) {
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Paid',
                        'full_paid' => $due_amount,
                        'due' => 0.00
                    ]);
                } else {
                    $rest_amount = $collection->collection_amount - $collection->ait - $collection->addi_dis_amount - $collection->return_amount - $data['collected_payment'];
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Partial | Paid',
                        'partial_paid' => $data['collected_payment'],
                        'due' => $rest_amount
                    ]);
    
                    Collection::create([
                        'order_invoice_id' => $collection->order_invoice_id,
                        'status' => 'Partial Payment',
                        'collection_amount' => $rest_amount,
                        'due' => $rest_amount,
                    ]);
                }
            }
        } else {
            if ($collection->status === 'Due') {
                if ($data['collected_payment'] == $collection->due) {
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Paid',
                        'full_paid' => $data['collected_payment'],
                        'due' => 0.00
                    ]);
                } else {
                    $rest_amount = $collection->collection_amount - $collection->return_amount - $data['collected_payment'];
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Partial | Paid',
                        'partial_paid' => $data['collected_payment'],
                        'due' => $rest_amount
                    ]);
    
                    Collection::create([
                        'order_invoice_id' => $collection->order_invoice_id,
                        'status' => 'Partial Payment',
                        'collection_amount' => $rest_amount,
                        'due' => $rest_amount
                    ]);
                }      
            }
    
            if ($collection->status === 'Partial Payment') {
                if ($data['collected_payment'] == $collection->due) {
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Paid',
                        'full_paid' => $data['collected_payment'],
                        'due' => 0.00
                    ]);
                } else {
                    $rest_amount = $collection->collection_amount - $collection->return_amount - $data['collected_payment'];
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Partial | Paid',
                        'partial_paid' => $data['collected_payment'],
                        'due' => $rest_amount
                    ]);
    
                    Collection::create([
                        'order_invoice_id' => $collection->order_invoice_id,
                        'status' => 'Partial Payment',
                        'collection_amount' => $rest_amount,
                        'due' => $rest_amount,
                    ]);
                }     
            }
        }

        return response()->json([
            'collected_payment' => $data['collected_payment'],
            'additional_discount' => $data['additional_discount']
        ]);
    }

    public function updateCopy2(Request $request, $id) 
    {
        $auth_user = Auth::user()->id;

        $data = $request->validate([
            'collected_payment' => 'required|numeric',
            'additional_discount' => 'nullable|numeric'
        ]);

        $additional_discount = $data['additional_discount'] ?? 0;
        $collected_payment = $data['collected_payment'];

        $collection = Collection::findOrFail($id);

        // Handle both additional_discount and collected_payment
        if ($additional_discount > 0) {
            // Update collection for additional discount first
            $collection_amount = $collection->collection_amount - $additional_discount;

            $collection->update([
                'collection_amount' => $collection_amount,
                'addi_dis_amount' => $additional_discount
            ]);

            if ($collection->status === 'Due') {
                if ($collection_amount === $collection->collection_amount) {
                    $collection->update([
                        'user_id' => $auth_user,
                        'status' => 'Paid',
                        'full_paid' => $collection_amount,
                        'due' => 0.00
                    ]);
                }
            } 
        }

        // Handle collected_payment logic
        if ($collection->status === 'Due') {
            if ($collected_payment === $collection->collection_amount) {
                $collection->update([
                    'user_id' => $auth_user,
                    'status' => 'Paid',
                    'full_paid' => $collected_payment,
                    'due' => 0.00
                ]);
            } else {
                $rest_amount = $collection->collection_amount - $collected_payment;
                $collection->update([
                    'user_id' => $auth_user,
                    'status' => 'Partial | Paid',
                    'partial_paid' => $collected_payment,
                    'due' => $rest_amount
                ]);

                Collection::create([
                    'order_invoice_id' => $collection->order_invoice_id,
                    'status' => 'Partial Payment',
                    'collection_amount' => $collection->due,
                ]);
            }
        } elseif ($collection->status === 'Partial Payment') {
            if ($collected_payment === $collection->collection_amount) {
                $collection->update([
                    'user_id' => $auth_user,
                    'status' => 'Paid',
                    'full_paid' => $collected_payment,
                    'due' => 0.00
                ]);
            } else {
                $rest_amount = $collection->collection_amount - $collected_payment;
                $collection->update([
                    'user_id' => $auth_user,
                    'status' => 'Partial | Paid',
                    'partial_paid' => $collected_payment,
                    'due' => $rest_amount
                ]);

                Collection::create([
                    'order_invoice_id' => $collection->order_invoice_id,
                    'status' => 'Partial Payment',
                    'collection_amount' => $collection->due,
                ]);
            }
        }

        return response()->json([
            'collected_payment' => $collected_payment,
            'additional_discount' => $additional_discount
        ]);
    }


    // not needed for now
    protected function updateCollectionAsPaid(Collection $collection, $auth_user, $payment)
    {
        $collection->update([
            'user_id' => $auth_user,
            'status' => 'Paid',
            'full_paid' => $payment,
            'due' => 0.00,
        ]);
    }

    protected function updateCollectionAsPartial(Collection $collection, $auth_user, $payment)
    {
        $rest_amount = $collection->collection_amount - $payment;

        $collection->update([
            'user_id' => $auth_user,
            'status' => 'Partial | Paid',
            'partial_paid' => $payment,
            'due' => $rest_amount,
        ]);

        Collection::create([
            'order_invoice_id' => $collection->order_invoice_id,
            'status' => 'Partial Payment',
            'collection_amount' => $rest_amount,
        ]);
    }


    public function updateCopy(Request $request, $id)
    {
        $auth_user = Auth::id();

        $data = $request->validate([
            'collected_payment' => 'required|numeric',
            'additional_discount' => 'nullable|numeric|min:0',
        ]);

        $additional_discount = $data['additional_discount'] ?? 0;

        $collection = Collection::findOrFail($id);

        DB::transaction(function () use ($collection, $auth_user, $data, $additional_discount) {
            if ($additional_discount > 0) {
                $collection_amount = $collection->collection_amount - $additional_discount;
                $collection->update([
                    'collection_amount' => $collection_amount,
                    'addi_dis_amount' => $additional_discount,
                ]);
            }

            if (in_array($collection->status, ['Due', 'Partial Payment'])) {
                if ($data['collected_payment'] === $collection->collection_amount) {
                    $this->updateCollectionAsPaid($collection, $auth_user, $data['collected_payment']);
                } else {
                    $this->updateCollectionAsPartial($collection, $auth_user, $data['collected_payment']);
                }
            }
        });

        return response()->json([
            'collected_payment' => $data['collected_payment'],
            'additional_discount' => $data['additional_discount'],
        ]);
    }

    // not needed for now


    public function collected_payment(Request $request)
    {
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Collections Report', 'url' => null],
            ['title' => 'Collected Payment', 'url' => null]
        ];
        $data['collected_payment'] = Collection::whereIn('status', ['Paid', 'Partial Payment', 'Partial | Paid'])->get();

        return view('collections_report.collected_payment', $data);
    }

    public function return_order(Request $request, $id)
    {
        $auth_user = Auth::user()->id;
        $collection = Collection::findOrFail($id);

        foreach ($collection->order_invoice->orders as $order) {
            $order->update([
                'quantity' => 0,
                'return_qty' => $order->quantity,
                'total_amount' => 0.00
            ]);

            $depot_stock_product = $order->depot_stock_product;

            $previous_stock = $depot_stock_product->quantity;
            $depot_stock_product->update([
                'quantity' => $previous_stock + $order->return_qty
            ]);

            $ware_house_stock = WarehouseStock::where('id', $order->depot_stock_product->warehouse_stock_id)->first();
            $curr_all_de_stock = DepotStockProduct::where('sku', $order->sku)->get();
            $total_stock = $curr_all_de_stock->sum('quantity') + $ware_house_stock->quantity;

            // $previous_stock = Transection::where('sku', $order->sku)
            //     ->orderBy('created_at', 'desc') // or use 'id' if your transactions are sequential
            //     ->first();

            // $previous_national_stock = $previous_stock ? $previous_stock->curr_national_stock : 0;

            Transection::create([
                'depot_id' => $order->depot_stock_product->depot_id,
                // 'product_name' => $order->product_name,
                'sku' => $order->sku,
                'invoice_number' => $collection->order_invoice->invoice_number,
                'order_number' => $order->order_number,
                'tran_type' => 'Sales Point to Depot',
                'status' => 'Return',
                'pre_stock' => $previous_stock,
                'tran_quant' => $order->return_qty,
                'curr_stock' => $depot_stock_product->quantity,
                'national_stock' => $total_stock
            ]);
        }

        $collection->order_invoice->update([
            'status' => 'Return',
            'sell_discount_amount' => 0.00,
            'return_amount' => $collection->order_invoice->total_amount
        ]);

        $collection->update([
            'user_id' => $auth_user,
            'status' => 'Return',
            'collection_amount' => $collection->order_invoice->total_amount,
            'due' => 0.00,
            'return_amount' => $collection->order_invoice->total_amount
        ]);

        $this->daily_stock_service->storeDailyStock();

        return redirect()->route('collections_report.dues');
        // return response()->json(['message' => 'Successfully Return'], 200);
    }

    public function return_order_and_edit_invoice(Request $request, $id)
    {
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Order Management', 'url' => null],
            ['title' => 'Return Order and Edit Invoice', 'url' => null]
        ];
        $data['collection'] = Collection::with(
            'order_invoice.orders.depot_stock_product',
            'order_invoice.sales_point.depot', 
            'order_invoice.delivery_man.employee',
            'order_invoice.user.employee'
        )->find($id);

        return view('pages.collections.edit', $data);
    }

    public function return_order_and_update_invoice(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $collection = Collection::find($id);
            $invoice = $collection->order_invoice;
            $return_note = $request->return_note;

            if (!$invoice) {
                DB::rollBack();
                return back()->with('error', 'Order invoice not found.');
            }

            $total_return_value = 0;

            foreach ($invoice->orders as $order) {
                $order_id = $order->id;
                
                $data = $request->validate([
                    'return_qty.' . $order_id => 'nullable|numeric'
                ]);

                $return_qty = $data['return_qty'][$order_id];

                if ($return_qty > $order->quantity) {
                    DB::rollBack();
                    return back()->with('error', "Return quantity for order {$order->order_number} exceeds original quantity.");
                }

                $remain_qty = $order->quantity - $return_qty;
                $return_value = $order->sell_unit_price * $return_qty;

                $order->update([
                    'quantity' => $remain_qty,
                    'return_qty' => $order->return_qty + $return_qty,
                    'total_amount' => $order->sell_unit_price * $remain_qty
                ]);

                $total_return_value += $return_value;

                $depot_stock_product = $order->depot_stock_product;
                if (!$depot_stock_product) {
                    DB::rollBack();
                    return back()->with('error', "Depot stock product not found for order {$order->order_number}.");
                }

                $previous_stock = $depot_stock_product->quantity;
                $updated_quantity = $previous_stock + $return_qty;

                $depot_stock_product->update([
                    'quantity' => $updated_quantity,
                ]);

                if ($return_qty > 0) {
                    $warehouse_stock = WarehouseStock::find($depot_stock_product->warehouse_stock_id);
                    if (!$warehouse_stock) {
                        DB::rollBack();
                        return back()->with('error', 'Warehouse stock not found.');
                    }

                    $curr_all_de_stock = DepotStockProduct::where('sku', $order->sku)->get();
                    $total_stock = $curr_all_de_stock->sum('quantity') + $warehouse_stock->quantity;

                    ReturnTrack::create([
                        'order_invoice_id' => $collection->order_invoice->id,
                        'order_id' => $order->id,
                        'user_id' => auth()->user()->id,
                        'product_name' => $order->product_name,
                        'sku' => $order->sku,
                        'return_qty' => $return_qty
                    ]);

                    Transection::create([
                        'depot_id' => $order->depot_stock_product->depot_id,
                        // 'product_name' => $order->product_name,
                        'sku' => $order->sku,
                        'invoice_number' => $collection->order_invoice->invoice_number,
                        'order_number' => $order->order_number,
                        'tran_type' => 'Sales Point to Depot',
                        'status' => 'Return',
                        'pre_stock' => $previous_stock,
                        'tran_quant' => $return_qty,
                        'curr_stock' => $order->depot_stock_product->quantity,
                        'national_stock' => $total_stock,
                        'sales_value' => $return_value
                    ]);
                }
            }

            $collection->order_invoice->update([
                'status' => 'Partial Return',
                'return_amount' => $collection->order_invoice->return_amount + $total_return_value,
                'return_note' => $return_note ?? $collection->order_invoice->return_note
            ]);

            $collection->update([
                'return_amount' => $collection->return_amount + $total_return_value,
                'due' => $collection->collection_amount - ($collection->return_amount + $total_return_value)
            ]);

            $this->daily_stock_service->storeDailyStock();

            DB::commit();

            return redirect()->route('collections_report.dues')->with('success', 'Return processed successfully.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
