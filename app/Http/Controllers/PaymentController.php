<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Package;
use App\Models\Payment_method;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::where('status','<>','DELETED')->paginate(10);
        $payments->load('patient');
        $payments->load('consultation');
        $payments->load('package');
        $payments->load('payment_method');

        return inertia('Payments/index',['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all(); 
        $payment_methods = Payment_method::all(); 

        return inertia('Payments/create', [ 'patients' => $patients , 'payment_methods' => $payment_methods]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search_consultation (Request $request){
        //$data = $request;
        dd($request->input('patient'));
        //return "recibido el paciente "+$request;
    }
}
