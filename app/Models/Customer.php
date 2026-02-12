<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    use SoftDeletes;

    public function custContact()
    {
        return $this->belongsTo(CustContact::class, 'cust_contact_id');
    }

    public function custMembership()
    {
        return $this->belongsTo(CustMembership::class, 'membership_id');
    }

    public function custData()
    {
        return $this->belongsTo(CustData::class, 'cust_data_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = [
        'user_id',
        'cust_data_id',
        'cust_contact_id',
        'membership_id',
    ];
}
