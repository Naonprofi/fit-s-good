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
            $table->unsignedBigInteger('worker_data_id')->nullable();
            $table->unsignedBigInteger('worker_contact_id')->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->unsignedBigInteger('job_title_id')->nullable();
            $table->foreign('worker_data_id')->references('id')->on('worker_data')->nullOnDelete();
            $table->foreign('worker_contact_id')->references('id')->on('worker_contacts')->nullOnDelete();
            $table->foreign('schedule_id')->references('id')->on('worker_schedules')->nullOnDelete();
            $table->foreign('job_title_id')->references('id')->on('worker_job_titles')->nullOnDelete();
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
