<?php

namespace Module\Inventory\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Module\Inventory\Models\Stock;
use Module\Inventory\Models\Product;

use Illuminate\Support\Facades\Log;
use Module\Report\Models\Transection;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class StockController extends Controller
{
    public function stocks(Request $request)
    {
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Stocks', 'url' => null],
        ];

        $fromDate = $request->filled('fromDate') && Carbon::hasFormat($request->fromDate, 'Y-m-d')
            ? Carbon::parse($request->fromDate)->startOfDay()
            : Carbon::today()->startOfDay();

        $toDate = $request->filled('toDate') && Carbon::hasFormat($request->toDate, 'Y-m-d')
            ? Carbon::parse($request->toDate)->endOfDay()
            : Carbon::today()->endOfDay();

        $data['stocks'] = Transection::select(
            'sku',
            'product_name',
            DB::raw('MIN(pre_stock) as opening_stock'),
            DB::raw('MAX(curr_stock) as closing_stock'),
            DB::raw("SUM(CASE WHEN status = 'Stock In' THEN tran_quant ELSE 0 END) as total_in"),
            DB::raw("SUM(CASE WHEN status = 'Stock Out' THEN tran_quant ELSE 0 END) as total_out"),
            DB::raw("SUM(CASE WHEN status = 'Return' THEN tran_quant ELSE 0 END) as total_return")
        )
        ->whereBetween('created_at', [$fromDate, $toDate])
        ->when($request->filled('sku'), function ($query) use ($request) {
            $query->where('sku', $request->sku);
        })
        ->groupBy('sku', 'product_name')
        ->paginate(30);

        // $data['stocks'] = Stock::orderBy('id', 'desc')->paginate(30);

        return view('Inventory::stocks.list', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'numeric|min:1'
        ]);

        $userId = auth()->user()->id;

        foreach ($data['product_id'] as $index => $product_id) {
            $product = Product::findOrFail($product_id);
            $sku = $product->sku;

            $existingStock = Stock::where('sku', $sku)->first();
            $preStockQuantity = $existingStock ? $existingStock->quantity : 0;

            if ($existingStock) {
                $existingStock->update([
                    'quantity' => $existingStock->quantity + $data['quantity'][$index]
                ]);
                
            } else {
                $stock = Stock::create([
                    'product_name' => $product->title,
                    'sku' => $product->sku,
                    'quantity' => $data['quantity'][$index],
                    'unit_price' => $product->unit_price
                ]);
            }
    
            Transection::create([
                'user_id' => $userId,
                'stock_id' => $existingStock ? $existingStock->id : $stock->id,
                'product_name' => $product->title,
                'sku' => $product->sku,
                'pre_stock' => $preStockQuantity,
                'tran_quant' => $data['quantity'][$index],
                'curr_stock' => $preStockQuantity + $data['quantity'][$index],
                'tran_type' => 'Warehouse Stock In',
                'status' => 'Stock In'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Stocks added successfully!',
        ]);
    }

    public function stocks_by_category_name(Request $request)
    {
        $categoryName = $request->query('category_name');

        if ($categoryName == 'seed') {
            $products = Product::whereHas('category', function ($query) {
                $query->where('slug', 'seed');
            })->get();

            // Extract SKUs from the products
            $productSkus = $products->pluck('sku');

            // Fetch all stocks that match those SKUs
            $stocks = Stock::whereIn('sku', $productSkus)->get();
        }

        if ($categoryName == 'agrochemicals') {
            $products = Product::whereHas('category', function ($query) {
                $query->whereIn('slug', ['pesticide', 'fertilizer']);
            })->get();

            // Extract SKUs from the products
            $productSkus = $products->pluck('sku');

            // Fetch all stocks that match those SKUs
            $stocks = Stock::whereIn('sku', $productSkus)->get();
        }

        return response()->json([
            'stocks' => $stocks,
        ]);
    }

    // API
    public function availabel_stocks(Request $request)
    {
        try {
            $stocks = Stock::whereNot('quantity', 0)->get();

            // Check if any products are not found
            if ($stocks->isEmpty()) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'No products found.'
                ], 200);
            }

            // Serialize products using a foreach loop
            $serializeStocks = [];
            foreach ($stocks as $stock) {
                $product = Product::where('sku', $stock->sku)->first();
                $serializeStocks[] = [
                    'stock_id' => $stock->id,
                    'category' => $product->category->name,
                    'product_name' => $stock->product_name,
                    'sku' => $stock->sku,
                    'unit_price' => $stock->mrp
                ];
            }

            // Return successful response
            return response()->json([
                'status' => 'SUCCESS',
                'data' => $serializeStocks,
                'message' => 'Products retrieved successfully.'
            ], 200);

        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Failed to retrieve products.',
                'error' => $e->getMessage() // Optionally include the error message in development
            ], 200);
        }
    }
}
