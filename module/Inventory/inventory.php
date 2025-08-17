<?php

use Illuminate\Support\Facades\Route;

use Module\Inventory\Controllers\StockController;
use Module\Inventory\Controllers\ProductController;
use Module\Inventory\Controllers\CategoryController;
use Module\Inventory\Controllers\SubCategoryController;

Route::prefix('/catalog')->name('catalog.')->group(function () {
    // categories
    Route::get('/categories', [CategoryController::class, 'categories'])->name('categories');
    // Route::post('/store-category', [CategoryController::class, 'store'])->name('store_category');

    // sub categories
    Route::get('/sub-categories', [SubCategoryController::class, 'subCategories'])->name('subCategories');
    // Route::post('/store-sub-category', [SubCategoryController::class, 'store'])->name('store_sub_category');

    Route::get('/sub-categories-by-category_{id}', [SubCategoryController::class, 'subCategories_by_category_'])->name('subCategories_by_category_');

    // products
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    Route::post('/store-product', [ProductController::class, 'store'])->name('store_product');
    Route::get('/product/{id}', [ProductController::class, 'product'])->name('product');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('update_product');

    Route::get('/products-by-category-name', [ProductController::class, 'products_by_category_name'])->name('products_by_category_name');
});

Route::get('/stocks', [StockController::class, 'stocks'])->name('stocks');
Route::post('/store-stocks', [StockController::class, 'store'])->name('store_stocks');

Route::get('/stocks-by-category-name', [StockController::class, 'stocks_by_category_name'])->name('stocks_by_category_name');