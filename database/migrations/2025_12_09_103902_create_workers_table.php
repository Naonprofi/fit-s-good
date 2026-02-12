<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_data_id');
            $table->unsignedBigInteger('worker_contact_id');
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('job_title_id');
            $table->foreign('worker_data_id')->references('id')->on('worker_data')->cascadeOnDelete();
            $table->foreign('worker_contact_id')->references('id')->on('worker_contacts')->cascadeOnDelete();
            $table->foreign('schedule_id')->references('id')->on('worker_schedules')->cascadeOnDelete();
            $table->foreign('job_title_id')->references('id')->on('worker_job_titles')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
