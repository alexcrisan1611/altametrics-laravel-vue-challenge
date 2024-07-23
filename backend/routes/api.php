<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Auth route.
Route::post('auth', [AuthController::class, 'store'])->name('auth.store');

// Invoices routes.
Route::get('invoices/total', [InvoiceController::class, 'total'])->name('invoices.total');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('invoices')
        ->name('invoices.')
        ->group(function () {
            Route::get('', [InvoiceController::class, 'index'])->name('index');
            Route::get('{invoice}', [InvoiceController::class, 'show'])
                ->where('invoice', '[0-9]+')
                ->name('show');
        });
});
