<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerData extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerDataFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['worker_gender', 'worker_name', 'worker_age'];

    public function worker()
    {
        return $this->hasOne(Worker::class);
    }
}
