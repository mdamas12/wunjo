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
        Schema::create('payroll_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payroll_id')->unsigned();
            $table->unsignedBigInteger('consultation_id')->unsigned()->nullable();
            $table->unsignedBigInteger('package_id')->unsigned()->nullable();
            $table->float('amount'); 
            $table->timestamps();

            $table->foreign('payroll_id')->references('id')->on('payrolls');
            $table->foreign('consultation_id')->references('id')->on('consultations');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_details');
    }
};
