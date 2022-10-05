<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'serial',
        'name',
        'price',
        'quantity',
        'description',
        'featured'
    ];

    public function orderItem(){
        return $this->belongsTo(OrderItem::class);
    }
}
