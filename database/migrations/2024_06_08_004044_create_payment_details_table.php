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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id')->unsigned();
            $table->unsignedBigInteger('consultation_id')->unsigned()->nullable();
            $table->unsignedBigInteger('package_id')->unsigned()->nullable();
            $table->unsignedBigInteger('service_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('consultation_id')->references('id')->on('consultations');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('service_id')->references('id')->on('services');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
