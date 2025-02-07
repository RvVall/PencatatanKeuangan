<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

// Redirect halaman utama ke daftar transaksi
Route::get('/', function () {
    return redirect()->route('transactions.index');
});

// Resource untuk transaksi (CRUD)
Route::resource('transactions', TransactionController::class);
Route::get('/transactions/print/{month}', [TransactionController::class, 'print'])->name('transactions.print');
