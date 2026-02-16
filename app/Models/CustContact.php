<?php

namespace App\Models;

use App\Policies\CustContactPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustContact extends Model
{
    /** @use HasFactory<\Database\Factories\CustContactFactory> */
    use HasFactory;
    use SoftDeletes;
    #[UsePolicy(CustContactPolicy::class)]

    protected $fillable = ['cust_email', 'cust_phone_num'];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
