<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustContact extends Model
{
    /** @use HasFactory<\Database\Factories\CustContactFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['cust_email', 'cust_phone_num'];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
