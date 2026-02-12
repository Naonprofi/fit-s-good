<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['date', 'period', 'guests'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    

}
