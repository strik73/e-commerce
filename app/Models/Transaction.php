<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $primaryKey = 'no_transaction';
    public $incrementing = false;
    protected $fillable = [
        'no_transaction',
        'item_no_item',
        'user_id',
        'quantity',
        'total_price',
        'status'
    ];

    public static function generateTransaction($date)
    {
        $prefix = 'ORD';
        $tanggal = Carbon::parse($date)->format('ymd');

        $latest = Transaction::where('no_transaction', 'like', $prefix . '-' . '%' . '-%')
            ->latest('created_at')
            ->first();

        if ($latest) {
            $lastIncrementPart = intval(substr($latest->no_transaction, -4));
            $incrementPart = str_pad($lastIncrementPart + 1, 5, '0', STR_PAD_LEFT);
        } else {

            $incrementPart = '00001';
        }

        $no_transaction = $prefix . '-' . $tanggal . '-' . $incrementPart;

        return $no_transaction;
    }
    public function items()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payments()
    {
        return $this->hasOne(Payment::class, 'transaction_no_transaction', 'no_transaction');
    }
}
