<?php

use Illuminate\Support\Facades\Route;

use Module\Sales\Controllers\CollectionController;
use Module\Sales\Controllers\OrderInvoiceController;

Route::prefix('/order')->name('order.')->group(function () {
    Route::get('/invoices', [OrderInvoiceController::class, 'invoices'])->name('invoices');
    Route::get('/create-invoice', [OrderInvoiceController::class, 'create'])->name('create_invoice');
    Route::get('/create-invoice-cpy', [OrderInvoiceController::class, 'create_cpy'])->name('create_invoice_cpy'); // cpy for making older invoice 
    Route::post('/store-invoice', [OrderInvoiceController::class, 'store'])->name('store_invoice');
    Route::post('/store-invoice-cpy', [OrderInvoiceController::class, 'store_cpy'])->name('store_invoice_cpy');

    Route::get('/edit-invoice/{id}', [OrderInvoiceController::class, 'edit'])->name('edit');
    Route::post('/update-order/{id}', [OrderInvoiceController::class, 'update_order'])->name('update_order');
    Route::put('/update-invoice/{id}', [OrderInvoiceController::class, 'update'])->name('update_invoice');
    Route::get('/cancel-invoice/{id}', [OrderInvoiceController::class, 'cancel'])->name('cancel_invoice');

    Route::get('/accepted-invoices', [OrderInvoiceController::class, 'accepted_invoices'])->name('accepted_invoices');
    Route::get('/invoice/{id}', [OrderInvoiceController::class, 'invoice'])->name('invoice');
    Route::get('/return-invoice/{id}', [OrderInvoiceController::class, 'return_invoice'])->name('return_invoice');
});

Route::prefix('/collection')->name('collection.')->group(function () {
    Route::get('/dues', [CollectionController::class, 'dues'])->name('dues');
    Route::post('/update-due', [CollectionController::class, 'updateDue'])->name('update_due');
});