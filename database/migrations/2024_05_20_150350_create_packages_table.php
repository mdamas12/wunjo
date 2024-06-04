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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('patient_id')->unsigned();
            $table->unsignedBigInteger('service_id')->unsigned();
            $table->integer('made_quantity');
            $table->string('status'); // activo / culminado 
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
