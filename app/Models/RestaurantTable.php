<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    protected $fillable = ['table_number', 'capacity', 'status'];

    public function activeOrder()
    {
        return $this->hasOne(Order::class, 'table_id')
            ->where('is_paid', false)
            ->latest();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }
}
