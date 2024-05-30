<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_no_transaction',
        'method',
        'amount',
        'status'
    ];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'transaction_no_transaction', 'no_transaction');
    }
}

