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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('method_type_id')->unsigned();
            $table->string('titular', 30);
            $table->string('bank', 30); 
            $table->string('phone', 30); 
            $table->string('identification', 30); 
            $table->string('email', 30); 
            $table->string('code', 30); 
            $table->string('var_1', 30); 
            $table->string('var_2', 30); 
            $table->boolean('status'); 
            $table->timestamps();

            $table->foreign('method_type_id')->references('id')->on('method_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
