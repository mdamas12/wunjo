<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use Inertia\Inertia;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(5);
        return inertia('Patients/index',['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Patients/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $newPatient =   Patient::create([
            'fist_name' => $request->fist_name,
            'last_name' => $request->last_name,    
            'identification' => $request->identification,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'status' => $request->status,

        ]);

        return redirect()->route('patients.index');
    
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
    public function edit(Patient $patient)
    {
        return inertia('Patients/edit',['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());
        return redirect()->route('patients.index')->with('success_message', 'Paciente Actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Patient $patient)
    {
        $patient->delete();
     
        return redirect()->route('patients.index')->with('success_message', 'Paciente Eliminado satisfactoriamente');
   
    }
}
