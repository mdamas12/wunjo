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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->unsigned();
            $table->unsignedBigInteger('patient_id')->unsigned();
          //  $table->unsignedBigInteger('schedule_id')->unsigned();                        
            $table->unsignedBigInteger('employee_id')->unsigned();
           // $table->string('reason',50); //motivo de la consulta
            $table->date('date');
            $table->time('hour');
            $table->float('amount');
            $table->float('amount_paid');
            $table->boolean('haspackage');
            $table->string('status'); //Pendiente / Realizada.
            $table->string('status_payment'); //por cancelar - pago parcial - pagada - paquete.
            $table->boolean('status_payroll'); 
            $table->timestamps();

           // $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
