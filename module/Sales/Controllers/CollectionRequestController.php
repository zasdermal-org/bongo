<?php

namespace Module\Sales\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Module\Sales\Models\OrderInvoice;
use Module\Sales\Models\CollectionRequest;
use Module\Market\Models\Territory;

use Carbon\Carbon;

class CollectionRequestController extends Controller
{
    public function submitDuePayment(Request $request)
    {
        $request->validate([
            // 'selected_invoices'   => 'required|array|min:1',
            'sale_point_id'     => 'required|integer|distinct|exists:sale_points,id',

            // 'adjustment_amt' => 'nullable|numeric|min:0|required_without:total_collect',
            'total_collection'  => 'nullable|numeric|min:1',

            'invoice_type'      => 'required|string',
            'payment_type'      => 'required|string',
            'receipt_no'        => 'nullable|string',
            'date'              => 'required|date',
            'remarks'           => 'nullable|string',
        ]);

        try {

            $totalCollect = $request->total_collection ?? 0;
            // $extraDiscount = $request->adjustment_amt ?? 0;

            // if ($totalCollect <= 0 && $extraDiscount <= 0) {
            //     return response()->json([
            //         'status' => 'ERROR',
            //         'message' => 'Payment or adjustment amount must be greater than zero.'
            //     ], 422);
            // }

            // $invoices = OrderInvoice::whereIn('id', $request->selected_invoices)->get();

            // if ($invoices->count() != count($request->selected_invoices)) {
            //     return response()->json([
            //         'status' => 'ERROR',
            //         'message' => 'Some selected invoices were not found.'
            //     ], 422);
            // }

            // Check all invoices belong to the same sale point
            // if ($invoices->pluck('sale_point_id')->unique()->count() > 1) {
            //     return response()->json([
            //         'status' => 'ERROR',
            //         'message' => 'Please select invoices from the same sale point.'
            //     ], 422);
            // }

            // Check invoice eligibility
            // foreach ($invoices as $invoice) {

            //     if (
            //         in_array($invoice->status, ['Requested', 'Reviewed', 'Cancel']) ||
            //         !in_array($invoice->payment_status, ['Due', 'Partial Paid']) ||
            //         $invoice->due <= 0
            //     ) {
            //         return response()->json([
            //             'status' => 'ERROR',
            //             'message' => 'One or more selected invoices are not eligible for payment.'
            //         ], 422);
            //     }
            // }

            // Preserve selected invoice order for FIFO processing
            // $selectedInvoices = collect($request->selected_invoices)
            //     ->map(fn ($id) => (int) $id)
            //     ->values()
            //     ->toArray();

            $collectionRequest = CollectionRequest::create([
                'submitted_by_user_id'  => auth()->user()->id,
                'sale_point_id'         => $request->sale_point_id,
                // 'selected_invoices'     => $selectedInvoices,
                'total_collect'         => $totalCollect,
                // 'adjustment_amt'        => $extraDiscount,
                'invoice_type'          => $request->invoice_type,
                'payment_type'          => $request->payment_type,
                'receipt_number'        => $request->receipt_no ?? null,
                'collection_date'       => $request->date,
                'status'                => 'Pending',
                'remarks'               => $request->remarks ?? null
            ]);

            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'Payment submitted successfully. Waiting for approval.',
                'data' => $collectionRequest
            ], 201);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to submit payment: ' . $e->getMessage()
            ], 500);
        }
    }


    public function paymentStatus(Request $request)
    {
        $query = CollectionRequest::query();

        $userIds = [68, 70];

        if (in_array(auth()->id(), $userIds)) {
            $query->whereDoesntHave('salePoint.territory', function ($q) {
               $q->where('name', 'Corporate');
            });
        }

        // Parse date filters
        $fromDate = $request->filled('fromDate') && Carbon::hasFormat($request->fromDate, 'Y-m-d')
            ? Carbon::parse($request->fromDate)->startOfDay()
            : null;

        $toDate = $request->filled('toDate') && Carbon::hasFormat($request->toDate, 'Y-m-d')
            ? Carbon::parse($request->toDate)->endOfDay()
            : null;

        if ($request->filled('zone_id') && $request->zone_id != 0) {
            $zone_id = $request->zone_id;

            $territoryIds = Territory::whereHas('area.region.division.zone', function ($q) use ($zone_id) {
                $q->where('id', $zone_id);
            })->pluck('id');

            $query->whereHas('salePoint.territory', function ($q) use ($territoryIds) {
                $q->whereIn('id', $territoryIds);
            });
        }

        if ($request->filled('division_id') && $request->division_id != 0) {
            $division_id = $request->division_id;

            $territoryIds = Territory::whereHas('area.region.division', function ($q) use ($division_id) {
                $q->where('id', $division_id);
            })->pluck('id');

            $query->whereHas('salePoint.territory', function ($q) use ($territoryIds) {
                $q->whereIn('id', $territoryIds);
            });
        }

        if ($request->filled('region_id') && $request->region_id != 0) {
            $region_id = $request->region_id;
            $territoryIds = Territory::whereHas('area.region', function ($q) use ($region_id) {
                $q->where('id', $region_id);
            })->pluck('id');

            $query->whereHas('salePoint.territory', function ($q) use ($territoryIds) {
                $q->whereIn('id', $territoryIds);
            });
        }

        if ($request->filled('area_id') && $request->area_id != 0) {
            $area_id = $request->area_id;
            $territoryIds = Territory::whereHas('area', function ($q) use ($area_id) {
                $q->where('id', $area_id);
            })->pluck('id');

            $query->whereHas('salePoint.territory', function ($q) use ($territoryIds) {
                $q->whereIn('id', $territoryIds);
            });
        }

        if ($request->filled('territory_id') && $request->territory_id != 0) {
            $territory_id = $request->territory_id;

            $query->whereHas('salePoint.territory', function ($q) use ($territory_id) {
                $q->where('id', $territory_id);
            });
        }

        $query->whereBetween('created_at', [$fromDate, $toDate]);

        // $order_invoices = $query->with('user')->get()->sortBy(function ($order_invoice) {
        //     return $order_invoice->user->username;
        // });

        // $count_invoices = $order_invoices->count();

        $collection_requests = $query->get();

        $serializeData = [];

        foreach ($collection_requests as $collection) {
            $serializeData[] = [
                'collection_id' => $collection->id,
                'sale_point_name' => $collection->salePoint->name,
                'invoice_type' => $collection->invoice_type,
                'total_collection' => $collection->total_collect,
                'payment_type' => $collection->payment_type,
                'status' => $collection->status,
                'collection_date' => $collection->collection_date->setTimezone('Asia/Dhaka')->format('d M, Y / h:i A')
            ];
        }

        return response()->json([
            'status' => 'SUCCESS',
            'data' => $serializeData,
            'message' => 'Collection retrieved successfully.'
        ], 200);
    }

    public function invoiceDetails(Request $request)
    {
        try {

            $collectionId = $request->collection_id;

            $collection = CollectionRequest::find($collectionId);

            if (!$collection) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'Collection request not found.'
                ], 404);
            }

            $invoiceIds = array_map('trim', explode(',', $collection->selected_invoices));

            $invoices = OrderInvoice::whereIn('id', $invoiceIds)->get();

            $serializeInvoices = $invoices->map(function ($invoice) {
                return [
                    'invoice_id' => $invoice->id,
                    'invoice_number' => $invoice->invoice_number,
                    'total_amount' => $invoice->total_amount,
                    'paid' => $invoice->paid,
                    'due' => $invoice->due,
                    'invoice_date' => $invoice->invoice_date->setTimezone('Asia/Dhaka')->format('d M, Y / h:i A'),
                ];
            });

            return response()->json([
                'status' => 'SUCCESS',
                'data' => $serializeInvoices,
                'message' => 'Invoice details retrieved successfully.'
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
