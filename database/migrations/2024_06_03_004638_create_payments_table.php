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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('patient_id')->unsigned();
            $table->unsignedBigInteger('payment_method_id')->unsigned();
            $table->unsignedBigInteger('consultation_id')->unsigned()->nullable();
            $table->unsignedBigInteger('package_id')->unsigned()->nullable();
            $table->float('amount');
            $table->string('reference'); 
            $table->string('status'); // por cancelar - pagada - pago parcial  
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('payment_method_id')->references('id')->on('method_types');
            $table->foreign('consultation_id')->references('id')->on('consultations');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
