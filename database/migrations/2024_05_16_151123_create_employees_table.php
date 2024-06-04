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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fist_name',100);
            $table->string('last_name',100);
            $table->string('identification',100);
            $table->string('phone',100);
            $table->string('email',100);
            $table->unsignedBigInteger('position_id')->unsigned();
            $table->string('contract',20); // MONTO UNICO O PORCENTIAL
            $table->float('mount');
            $table->text('description')->max(200);
            $table->string('status');
            $table->timestamps();


            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
