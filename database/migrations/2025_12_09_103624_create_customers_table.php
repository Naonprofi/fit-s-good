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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cust_data_id');
            $table->unsignedBigInteger('membership_id');
            $table->unsignedBigInteger('cust_contact_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('cust_data_id')->references('id')->on('cust_data')->cascadeOnDelete();
            $table->foreign('membership_id')->references('id')->on('cust_membership')->cascadeOnDelete();
            $table->foreign('cust_contact_id')->references('id')->on('cust_contact')->cascadeOnDelete();
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
        Schema::dropIfExists('customers');
    }
};
