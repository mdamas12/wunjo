<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Consultation;
use App\Models\Consultation_detail;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Service; 
use App\Models\Package; 

use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index (){
       
     
       if (auth()->user() == null){
          return Inertia::render('Auth/Login');
       }

      /* $date = Carbon::now();
       $today = $date->toDateString();
      
       $consultations = Consultation::with('branch','patient','employee')
            ->where('status','<>','DELETED')
            ->where('status','<>','REALIZADA')
            ->where('date','=',$today)
            ->get();
    
        $pendinglist = Consultation::with('branch','patient','employee')
            ->where('status','<>','DELETED')
            ->where('status','<>','PENDIENTE')
            ->where('status_payment','=','PENDIENTE')
            ->get();

        */
        return Inertia::render('Dashboard', [ 
            //'ConsultationsPending' => $consultations,
            //'PaymentPending' => $pendinglist,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
           'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function dashboard(){
        return Inertia::render('Dashboard');
    }
}
