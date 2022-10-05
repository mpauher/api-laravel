<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'reference',
        'total',
        'subtotal',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderItem(){
        return $this->belongsTo(OrderItem::class);
    }
}
