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
        Schema::create('payroll_pays', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payroll_id')->unsigned();
            $table->unsignedBigInteger('payment_method_id')->unsigned();
            $table->float('amount'); 
            $table->string('reference'); 
            $table->string('url_capture'); 
            $table->timestamps();

            $table->foreign('payroll_id')->references('id')->on('payrolls');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_pays');
    }
};
