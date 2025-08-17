<?php

namespace Module\Inventory\Controllers;

use App\Http\Controllers\Controller;

use Module\Inventory\Models\Product;
use Module\Inventory\Models\Category;


use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $data['breadcrumbs'] = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Catalog', 'url' => null],
            ['title' => 'Products', 'url' => null]
        ];

        $data['categories'] = Category::all();
        $data['products'] = Product::orderBy('id', 'desc')->get();

        return view('Inventory::products.list', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'title' => 'required|string',
            'sku' => 'required|string|unique:products,sku',
            'unit_price' => 'required|numeric'
        ]);

        Product::create([
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'sku' => $data['sku'],
            'unit_price' => $data['unit_price']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added successfully',
        ]);
    }

    public function product($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'title' => $product->title,
            'unit_price' => $product->unit_price
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'unit_price' => 'required|numeric'
        ]);
        
        $product->update([
            'unit_price' => $data['unit_price']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
        ]);
    }

    public function products_by_category_name(Request $request)
    {
        $categoryName = $request->query('category_name');

        if ($categoryName == 'pesticide') {
            $products = Product::whereHas('category', function ($query) {
                $query->where('slug', 'pesticide');
            })->get();
        }

        if ($categoryName == 'fertilizer_seed') {
            $products = Product::whereHas('category', function ($query) {
                $query->whereIn('slug', ['fertilizer', 'seed']);
            })->get();
        }

        return response()->json([
            'products' => $products,
        ]);
    }
}
