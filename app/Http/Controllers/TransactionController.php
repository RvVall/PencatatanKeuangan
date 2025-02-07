<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        // Ambil transaksi dan kelompokkan per bulan (Y-m)
        $transactions = Transaction::orderByDesc('transaction_date')->get()
            ->groupBy(fn($val) => Carbon::parse($val->transaction_date)->format('Y-m'));

        // Hitung total pemasukan dan pengeluaran
        $income = Transaction::where('type', 'income')->sum('amount');
        $expense = Transaction::where('type', 'expense')->sum('amount');

        return view('transactions.index', compact('transactions', 'income', 'expense'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title'            => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0',
            'description'      => 'nullable|string',
            'transaction_date' => 'required|date',
            'type'             => 'required|in:income,expense',
        ]);

        // Simpan transaksi dengan format tanggal yang benar
        $validatedData['transaction_date'] = Carbon::parse($validatedData['transaction_date'])->format('Y-m-d');

        Transaction::create($validatedData);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Validasi input
        $validatedData = $request->validate([
            'title'            => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0',
            'description'      => 'nullable|string',
            'transaction_date' => 'required|date',
            'type'             => 'required|in:income,expense',
        ]);

        // Update data transaksi
        $validatedData['transaction_date'] = Carbon::parse($validatedData['transaction_date'])->format('Y-m-d');

        $transaction->update($validatedData);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
