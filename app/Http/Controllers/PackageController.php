<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use App\Models\Patient;
use App\Models\Service;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::where('status','<>','DELETED')->paginate(10);
        $packages->load('patient');
        $packages->load('service');
        return inertia('Packages/index',['packages' => $packages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('type',"PAQUETE")->get();
        $patients = Patient::all(); 
        return inertia('Packages/create', [ 'patients' => $patients , 'services' => $services]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        Package::create($request->validated());
        return redirect()->route('packages.index')->with('success_message', 'Consulta creada satisfactoriamente');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
    
        $patients = Patient::all();
        $services = Service::where('type',"PAQUETE")->get();
        $package->load('patient');
        $package->load('service');
   
    
        return inertia('Packages/show',['patient_package' => $package,'services' => $services, 'patients' => $patients]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $patients = Patient::all();
        $services = Service::where('type',"PAQUETE")->get();

        $package->load('patient');
        $package->load('service');

        return inertia('Packages/edit',['patient_package' => $package,'services' => $services, 'patients' => $patients]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, Package $package)
    {
    
       //dd($request);
        try {

            if ($package->update($request->validated())){
                return redirect()->route('packages.index')->with('success_message', 'Paquete Actualizado con exito');
            }
            else{
               return "error";
            }
           
         } catch (\Exception $e) { // It's actually a QueryException but this works too
            return "Ha ocurrido un error al intentar actualizar el paquete ";
         }

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_status( PackageRequest $request)
    {
        $package = Package::find($request->id);
        $package->update($request->validated());
        return redirect()->route('packages.index');
    }
}
