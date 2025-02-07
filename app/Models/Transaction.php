<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'amount', 
        'description', 
        'transaction_date', 
        'type' // Pastikan properti 'type' sudah ada
    ];
}
