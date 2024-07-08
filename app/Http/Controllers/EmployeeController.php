<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Position;
use Inertia\Response;



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
   
        $employees = Employee::where('status','true')->paginate(5);
        $employees->load('position');
        
        return inertia('Employees/index',['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = Position::all();
        return inertia('Employees/create', ['positions' => $positions ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());
        $employees = Employee::paginate(10);
        $employees->load('position');

        return inertia('Employees/index',['employees' => $employees])->with('success', 'Empleado creado satisfactoriamente');;
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
    public function edit(Employee $employee)
    {
        $positions = Position::all();
        $employee->load('position');
        return inertia('Employees/edit',['employee' => $employee, 'positions' =>$positions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employees.index')->with('success', 'Empleado Actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $employee = Employee::where('id',$id)->first();
        //dd($employee);
        $employee->status = 'false'; 
        $employee->update();
        session()->flash('flash.message', 'success');
        return redirect()->back();
    }
}
