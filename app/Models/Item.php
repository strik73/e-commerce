<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'no_item';
    public $incrementing = false;
    protected $fillable = [
        'no_item',
        'name',
        'user_id',
        'category_id',
        'stock',
        'price',
        'condition',
        'description',
        'status',
        'image',
        'imageSec',
        'imageThird'
    ];

    public static function generateItem($date, $name, $userid)
    {
        $prefix = 'ITM';
        $tanggal = Carbon::parse($date)->format('ymd');
        $namePart = substr($name, 0, 3);

        $latest = Item::where('no_item', 'like', $prefix . '-' . $tanggal . '-%')
            ->latest('created_at')
            ->first();

        if ($latest) {
            $lastIncrementPart = intval(substr($latest->no_item, -5));
            $incrementPart = str_pad($lastIncrementPart + 1, 5, '0', STR_PAD_LEFT);
        } else {

            $incrementPart = '00001';
        }

        $no_item = $prefix . '-' . strtoupper($namePart) . $userid . '-' . $tanggal . '-' . $incrementPart;

        return $no_item;
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'item_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
