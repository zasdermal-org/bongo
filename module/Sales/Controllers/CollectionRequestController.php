<?php

namespace Module\Sales\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Module\Sales\Models\OrderInvoice;
use Module\Sales\Models\CollectionRequest;

class CollectionRequestController extends Controller
{
    public function submitDuePayment(Request $request)
    {
        $request->validate([
            // 'selected_invoices'   => 'required|array|min:1',
            'sale_point_id' => 'required|integer|distinct|exists:sale_points,id',

            // 'adjustment_amt' => 'nullable|numeric|min:0|required_without:total_collect',
            'total_collect'  => 'nullable|numeric|min:1',

            'payment_type'   => 'required|string',
            'receipt_number' => 'nullable|string',
            'date'           => 'required|date',
        ]);

        try {

            $totalCollect = $request->total_collect ?? 0;
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
                'payment_type'          => $request->payment_type,
                'receipt_number'        => $request->receipt_number ?? null,
                'collection_date'       => $request->date,
                'status'                => 'Pending',
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
}
