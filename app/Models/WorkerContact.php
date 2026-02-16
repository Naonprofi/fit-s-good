<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerContact extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerContactFactory> */
    use HasFactory;
    use SoftDeletes;
    #[UsePolicy(WorkerContactPolicy::class)]

    protected $fillable = ['worker_email', 'worker_phone_num'];

    public function worker()
    {
        return $this->hasOne(Worker::class);
    }
}
