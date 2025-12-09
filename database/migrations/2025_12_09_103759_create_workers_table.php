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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('worker_data_id')->references('id')->on('worker_data')->cascadeOnDelete();
            $table->foreign('worker_contact_id')->references('id')->on('worker_contact')->cascadeOnDelete();
            $table->foreign('schedule_id')->references('id')->on('worker_schedule')->cascadeOnDelete();
            $table->foreign('job_title_id')->references('id')->on('worker_job_title')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
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
