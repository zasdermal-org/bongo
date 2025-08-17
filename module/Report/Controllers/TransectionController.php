<?php

namespace Module\Report\Controllers;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Module\Report\Models\Transection;

class TransectionController extends Controller
{
    public function transections(Request $request)
    {
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Report', 'url' => null],
            ['title' => 'Transections', 'url' => null]
        ];

        $query = Transection::query();

        // Filter by status (tran_type, status)
        if ($request->filled('status')) {
            $status = $request->status;

            $query->where(function ($q) use ($status) {
                $q->where('tran_type', $status)
                ->orWhere('status', $status);
            });
        }

        // Apply date filters if provided
        if ($request->filled('from_date') && Carbon::hasFormat($request->from_date, 'Y-m-d')) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $query->where('created_at', '>=', $fromDate);
        }

        if ($request->filled('to_date') && Carbon::hasFormat($request->to_date, 'Y-m-d')) {
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $query->where('created_at', '<=', $toDate);
        }

        // Default to today's data if no date filters are provided
        if (!$request->filled('from_date') && !$request->filled('to_date')) {
            $query->whereDate('created_at', Carbon::today());
        }

        // Fetch the transactions
        $data['transections'] = $query->orderBy('id', 'desc')->get();

        $data['total'] = $data['transections']->count();
        $data['trans_qty'] = $data['transections']->sum('tran_quant');

        $data['stock_in'] = $data['transections']->filter(function ($transection) {
            return $transection->status === 'Stock In';
        })->sum('tran_quant');

        $data['stock_out'] = $data['transections']->filter(function ($transection) {
            return $transection->status === 'Stock Out';
        })->sum('tran_quant');

        $data['return'] = $data['transections']->filter(function ($transection) {
            return $transection->status === 'Return';
        })->sum('tran_quant');

        return view('Report::transections', $data);
    }
}
