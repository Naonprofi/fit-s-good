<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerScheduleFactory> */
    use HasFactory;
    use SoftDeletes;
    #[UsePolicy(WorkerSchedulePolicy::class)]

    protected $fillable = ['schedule'];

    public function worker()
    {
        return $this->hasOne(Worker::class);
    }
}
