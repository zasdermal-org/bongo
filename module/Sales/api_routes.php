<?php

use Illuminate\Support\Facades\Route;

use Module\Sales\Controllers\CollectionController;
use Module\Sales\Controllers\OrderInvoiceController;

Route::prefix('/order')->group(function () {
    Route::post('/store-invoice', [OrderInvoiceController::class, 'api_store']);
    Route::post('/update-invoice', [OrderInvoiceController::class, 'updateInvoice']);
});

Route::prefix('/sales-report')->group(function () {
    Route::post('/sales', [OrderInvoiceController::class, 'sale_invoices']);
    Route::get('/sale/{id}', [OrderInvoiceController::class, 'sale_invoice_orders']);

    Route::post('/product-summary', [OrderInvoiceController::class, 'product_summary']);

    Route::post('/customer-sales', [OrderInvoiceController::class, 'customer_sales']);
    Route::post('/customer-ledger', [OrderInvoiceController::class, 'customer_ledger']);
});

Route::post('/collections', [CollectionController::class, 'collections']);