<?php

use Illuminate\Support\Facades\Route;

use Module\Sales\Controllers\OrderInvoiceController;

Route::prefix('/order')->group(function () {
    Route::post('/store-invoice', [OrderInvoiceController::class, 'api_store']);
});

Route::prefix('/sales-report')->group(function () {
    Route::post('/sales', [OrderInvoiceController::class, 'sale_invoices']);
    Route::get('/sale/{id}', [OrderInvoiceController::class, 'sale_invoice_orders']);
});