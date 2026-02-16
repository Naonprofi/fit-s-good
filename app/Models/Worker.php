<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerFactory> */
    use HasFactory;
    use SoftDeletes;
    #[UsePolicy(WorkerPolicy::class)]
    
    public function workerData()
    {
        return $this->belongsTo(WorkerData::class, 'worker_data_id');
    }

    public function workerContact()
    {
        return $this->belongsTo(WorkerContact::class, 'worker_contact_id');
    }

    public function workerSchedule()
    {
        return $this->belongsTo(WorkerSchedule::class, 'schedule_id');
    }

    public function workerJobTitle()
    {
        return $this->belongsTo(WorkerJobTitle::class, 'job_title_id');
    }
}
