<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['table_id', 'is_paid', 'total_amount', 'payment_method'];

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
