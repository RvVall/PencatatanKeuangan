<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        Transaction::create([
            'title' => 'Gaji Bulanan',
            'amount' => 5000000,
            'type' => 'income',
            'description' => 'Gaji bulan September',
            'transaction_date' => now(),
        ]);

        Transaction::create([
            'title' => 'Belanja',
            'amount' => 200000,
            'type' => 'expense',
            'description' => 'Beli kebutuhan harian',
            'transaction_date' => now(),
        ]);
    }
}

