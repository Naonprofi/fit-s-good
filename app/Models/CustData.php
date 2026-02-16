<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustData extends Model
{
    /** @use HasFactory<\Database\Factories\CustDataFactory> */
    use HasFactory;
    use SoftDeletes;
    #[UsePolicy(CustDataPolicy::class)]

    protected $fillable = ['cust_gender', 'cust_name', 'cust_age'];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
