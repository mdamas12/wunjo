<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ConsultationRequest;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Branch;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = Consultation::where('status','<>','DELETED')->paginate(10);
        $consultations->load('branch');
        $consultations->load('patient');
        $consultations->load('employee');

       
        return inertia('Consultations/index',['consultations' => $consultations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        $employees = Employee::all();
        $branches = Branch::all();
        return inertia('Consultations/create', ['branches' => $branches, 'patients' => $patients , 'employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConsultationRequest $request)
    {
        Consultation::create($request->validated());
        return redirect()->route('consultations.index')->with('success_message', 'Consulta creada satisfactoriamente');
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
    public function edit(Consultation $consultation)
    {
        $patients = Patient::all();
        $employees = Employee::all();
        $branches = Branch::all();

        $consultation->load('branch');
        $consultation->load('patient');
        $consultation->load('employee');

        return inertia('Consultations/edit',['consultation' => $consultation,'branches' => $branches, 'patients' => $patients , 'employees' => $employees]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConsultationRequest $request, Consultation $consultation)
    {
       
        dd($consultation);
        // $consultation->update($request->validated());

        //return redirect()->route('consultations.index')->with('success_message', 'Empleado Actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        /* por ahora no se eliminara el registro, solo cambiara de status */ 
        //$consulta = Consultation::query()->where('id', 2)->first();

       // echo('Some message here.');
       // $consultation->status = "inactiva";
        $consultation->delete();
       

        return redirect()->route('consultations.index')->with('success_message', 'Empleado Actualizado satisfactoriamente');
    }

    public function change_status( ConsultationRequest $request)
    {
        $consultation = Consultation::find($request->id);
        $consultation->update($request->validated());
        return redirect()->route('consultations.index');
    }

}
