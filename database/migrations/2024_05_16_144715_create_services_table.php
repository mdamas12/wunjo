<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * creara la tabla servicios
     * servira de tabla para guardar los distintos tratamientos que se puedan aplicar en la clinica
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('description')->max(200);
            $table->float('price');
            $table->integer('quantity'); //cantidad de terapias necesarias
            $table->string('type'); //tipo de servicio (normal(regular) | paquete(package))
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
