<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkerJobTitle extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerJobTitleFactory> */
    use HasFactory;
    use SoftDeletes;
    #[UsePolicy(WorkerJobTitlePolicy::class)]

    protected $fillable = ['title'];

    public function worker()
    {
        return $this->hasOne(Worker::class);
    }
}
