<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;


//No auth Routes
Route::get('/', [DashboardController::class, 'index']);
Route::put('/consultations/list', [ConsultationController::class, 'list'])->name('consultationslist');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
   
    //Auth Routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('branches', BranchController::class); // rutas para sucursales
    Route::resource('services', ServiceController::class); // rutas para Servicio o tratamientos
    Route::resource('promotions', PromotionController::class); // rutas para promociones o paquetes 
    Route::resource('employees', EmployeeController::class); // rutas para empleados
    Route::resource('patients', PatientController::class); // rutas para Pacientes
    Route::resource('consultations', ConsultationController::class); // rutas para consultas
    Route::resource('packages', PackageController::class); // rutas para Paquetes de cliente
    Route::resource('payments', PaymentController::class); // rutas para pagos de cliente
});

Route::post('/consultations/changestatus', [ConsultationController::class, 'change_status'])->name('changestatus');
Route::post('/packages/changestatus', [PackageController::class, 'change_status'])->name('changestatuspackage');
Route::get('/payments/searchconsultation/', [PaymentController::class, 'search_consultation'])->name('searchconsultation');
