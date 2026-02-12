<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustMembership extends Model
{
    /** @use HasFactory<\Database\Factories\CustMembershipFactory> */
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['type'];

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
