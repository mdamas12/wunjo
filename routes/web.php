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
use App\Http\Controllers\UserController;


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
    Route::resource('payrolls', PayrollController::class); // rutas para pagos de empleados
    Route::resource('users', UserController::class); // rutas Usuarios
    
});


 
Route::post('/users/seacrchroleuser', [UserController::class, 'seacrchroleuser'])->name('seacrchroleuser'); 
Route::post('/consultations/loadlist', [ConsultationController::class, 'loadlist'])->name('loadlist'); 
Route::post('/consultations/pendingpay', [ConsultationController::class, 'pendingPay'])->name('pendingpay'); 
Route::post('/consultations/listdetails', [ConsultationController::class, 'listdetails'])->name('listdetails'); 
Route::post('/consultations/deletedetail', [ConsultationController::class, 'deletedetail'])->name('deletedetail'); 
Route::post('/consultations/loadservices', [ConsultationController::class, 'loadservices'])->name('loadservices');
Route::post('/consultations/loadpackages', [ConsultationController::class, 'loadpackages'])->name('loadpackages');  
Route::post('/consultations/savedetail', [ConsultationController::class, 'savedetail'])->name('savedetail');
Route::post('/consultations/changestatus', [ConsultationController::class, 'change_status'])->name('changestatus');

Route::post('/packages/changestatus', [PackageController::class, 'change_status'])->name('changestatuspackage');
Route::post('/payments/searchconsultation', [PaymentController::class, 'search_consultation'])->name('searchconsultation');
Route::post('/payments/upload', [PaymentController::class, 'upload'])->name('upload');
Route::post('/payments/servicespayment', [PaymentController::class, 'servicespayment'])->name('servicespayment');
Route::post('/payments/deletepayment', [PaymentController::class, 'deletepayment'])->name('deletepayment');
