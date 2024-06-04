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
        Schema::create('consultation_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultation_id')->unsigned();
            $table->unsignedBigInteger('service_id')->unsigned();
            $table->unsignedBigInteger('package_id')->unsigned();
          //  $table->unsignedBigInteger('promotion_detail_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('consultation_id')->references('id')->on('consultations');
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('package_id')->references('id')->on('packages'); 
          //  $table->foreign('promotion_detail_id')->references('id')->on('promotion_details');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_details');
    }
};
