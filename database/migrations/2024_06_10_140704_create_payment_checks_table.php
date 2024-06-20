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
        Schema::create('payment_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id')->unsigned();
            $table->unsignedBigInteger('payment_method_id')->unsigned();
            $table->float('parcial_amount'); 
            $table->string('reference'); 
            $table->string('url_capture'); 
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_checks');
    }
};
