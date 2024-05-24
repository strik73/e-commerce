<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
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

    function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
