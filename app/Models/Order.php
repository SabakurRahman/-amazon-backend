<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function orderAddress()
    {
        return $this->belongsTo(OrderAddress::class,'order_address');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
