<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ConsultationRequest; 
use App\Http\Requests\ConsultationDetailRequest;
use App\Models\Consultation;
use App\Models\Consultation_detail;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Service; 
use App\Models\Package; 
use App\Models\Userbranch; 

use Carbon\Carbon;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

   
        //dd(auth()->user()->id);
        $branches_user = Userbranch::where('user_id',auth()->user()->id)->get();
        $consultations = Consultation::with('branch','patient','employee')
                  ->where('status','<>','DELETED')
                  ->orderBy('date', 'DESC')
                  ->where(function ($query) use($branches_user) {
                   foreach($branches_user as $key) {
                    $branch_id = $key['branch_id'];
                    $query->orWhere('branch_id', 'LIKE', "%$branch_id%");
                    
                   }
                })->paginate(10);
        return inertia('Consultations/index',['consultations_all' => $consultations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        //$employees = Employee::where();

        $employees = DB::select("SELECT e.id, e.fist_name, e.last_name FROM employees e 
                                INNER JOIN positions p ON e.position_id = p.id 
                                WHERE e.status = 'true' 
                                AND p.type = 'area'");

        $branches = Userbranch::with('branch')->where('user_id',auth()->user()->id)->get();
        //dd($branches);
        return inertia('Consultations/create', ['branches' => $branches, 'patients' => $patients , 'employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConsultationRequest $request)
    {
     
        Consultation::create($request->validated());
        return redirect()->route('consultations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultation $consultation)
    {
      
        $consultation->load('patient');
        $consultation->load('employee');
        $consultation->load('branch');
        $services = Service::all();
    
        return inertia('Consultations/show',['consultation' => $consultation, 'services' => $services]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultation $consultation)
    {
        $patients = Patient::all();
        $employees = DB::select("SELECT e.id, e.fist_name, e.last_name FROM employees e 
        INNER JOIN positions p ON e.position_id = p.id 
        WHERE e.status = 'true' 
        AND p.type = 'area'");
        $branches = Userbranch::with('branch')->where('user_id',auth()->user()->id)->get();

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
         $consultation->update($request->validated());
         return redirect()->route('consultations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultation $consultation)
    {
        /* por ahora no se eliminara el registro, solo cambiara de status */ 
        //$consultation->delete();
        //return redirect()->route('consultations.index');
    }

    public function change_status( ConsultationRequest $request)
    {
        $consultation = Consultation::find($request->id);
        $consultation->update($request->validated());
        return redirect()->route('consultations.index');
    }

    
   /** 
   * LISTA DE DETALLE DE LA CONSULTA SOLICITADA
   */
    public function listdetails(request $request){
       $consultation_id = $request->consultation_id;
       $prueba = Consultation_detail::with('service','package')
       ->where('consultation_id','=',$consultation_id)->get();
       $services = Service::all();

        session()->flash('flash.services', $services);
        session()->flash('flash.details', $prueba);
        return redirect()->back();
    
    }


  /**
   * LISTA DE SERVICIOS QUE AUN NO ESTAN EN LA CONSULTA SOLICITADA
   */
    public function loadservices(request $request){

        $consultation_id = $request->consultation_id;
        $type = "REGULAR";
        $services = DB::select("SELECT * FROM services 
                                WHERE services.type = 'REGULAR' AND NOT EXISTS 
                                (SELECT * FROM consultation_details 
                                WHERE  consultation_details.service_id = services.id
                                AND  consultation_details.consultation_id = '".$consultation_id."'  )");
     
        session()->flash('flash.services', $services);
        return redirect()->back();
    
    }

   /**
   * LISTAR LOS PAQUETES ACTIVOS DE LOS PACIENTES
   */

    public function loadpackages(request $request){
      $patient = $request->patient_id;
      $consultation_id = $request->consultation_id;
      $status_packages = "ACTIVO";
      $packages = DB::select("SELECT * FROM packages 
                    WHERE packages.patient_id = '".$patient."' 
                     AND packages.status = '".$status_packages."' 
                     AND NOT EXISTS 
                    (SELECT * FROM consultation_details 
                    WHERE  consultation_details.package_id = packages.id
                    AND  consultation_details.consultation_id = '".$consultation_id."'  )");
      //$packages = Package::where('patient_id', '=', $patient)->where('status','=','ACTIVO')->get();
     // $packages->load('service');
      session()->flash('flash.packages', $packages);
      return redirect()->back();
    }

   /**
   * AGREGAR SERVICIO A LA  CONSULTA SOLICITADA
   */

    public function savedetail(ConsultationDetailRequest $request){
       
        /**
         * Buscar el id del servicio. 
         */

        if (isset($request->service_id )){
            $service_id = $request->service_id;
            $service = Service::where('id',$service_id)->first();
        }
        else{
            $package_id = $request->package_id;
            $package = Package::where('id','=',$package_id)->first();   
            $service_id = $package->service_id;
            $service = Service::where('id',$service_id)->first();           
            $package->made_quantity += 1; 
            if($package->made_quantity == $service->quantity){
                $package->status = "REALIZADO";
            }
            $package->update();
        }
         /** Guardar detalle de la consulta */
         $Consultation_detail = Consultation_detail::create($request->validated());

         /**
         * Actualizar precio total de la consulta
         */

        $consultation_id = $request->consultation_id;
        $consultation = Consultation::where('id','=',$consultation_id)->first(); 
        
        if ($service->type == "REGULAR"){
            $consultation->amount += $service->price;
            $amount =  $consultation->amount;
            $consultation->update();
        }
        else{
            $amount =  $consultation->amount; 
            $consultation->haspackage = true;
            $consultation->update();
        }
        session()->flash('flash.amount', $amount);
         return redirect()->back();
    
    }

    /**
     * ELIMINAR DETALLE DE LA CONSULTA
     */

  
     public function deletedetail(request $request){


        $detail_id = $request->detail_id;
        $detail = Consultation_detail::where('id',$detail_id)->first();

        /**
         * Buscar el id del servicio. 
         */
        if (isset($detail)){

            if (isset($detail->service_id )){
                $service_id = $detail->service_id ;
                $service = Service::where('id',$service_id)->first(); 
                }
            else{
                $package_id = $detail->package_id;
                $package = Package::where('id','=',$package_id)->first();   
                $service_id = $package->service_id;
                $service = Service::where('id',$service_id)->first();           
                $package->made_quantity -= 1; 
                if($package->made_quantity < $service->quantity){
                    $package->status = "ACTIVO";
                }
                $package->update();
            }
            $consultation_id = $detail->consultation_id;
            //Elimnar detalle de la consulta 
            $detail->delete();
            /**
             * Actualizar precio total de la consulta
             */

          
            $consultation = Consultation::where('id','=',$consultation_id)->first(); 
            if ($service->type == "REGULAR"){
                $consultation->amount -= $service->price;
                $amount =  $consultation->amount;
                $consultation->update();
            }
            else{
                $amount =  $consultation->amount; 
            }
 
            session()->flash('flash.amount', $amount);

            return redirect()->back();
        }
        return redirect()->back();

     }

     public function loadlist(){

        $date = Carbon::now();
        $today = $date->toDateString();
        $consultations = Consultation::with('branch','patient','employee')
                                      ->where('status','<>','DELETED')
                                      ->where('status','<>','REALIZADA')
                                      ->where('date','=',$today)
                                      ->get();
        session()->flash('flash.ConsultationsList', $consultations);
        return redirect()->back();

     }

     public function pendingPay(){

        $consultations = Consultation::with('branch','patient','employee')
                                      ->where('status','<>','DELETED')
                                      ->where('status','<>','PENDIENTE')
                                      ->where('status_payment','=','PENDIENTE')
                                      ->get();
        session()->flash('flash.pendinglist', $consultations);
        return redirect()->back();

     }

     public function addevaluation (Request $request){
        $consultation = Consultation::where('id', $request->consultation)->first();

        if ($consultation){
            $consultation->evaluation = $request->evaluation;
            $consultation->diagnostic = $request->diagnostic;
            $consultation->update();

        }
        return redirect()->back();
     }

     public function process (Request $request){
        $consultation = Consultation::where('id', $request->consultation)->first();

        if ($consultation){
            $consultation->status = "REALIZADA";
            $consultation->status_payment = $request->status_payment;
            $consultation->update();

        }
        return redirect()->back();
     }

     public function searchp(Request $request){
        if ($request->lastname == ""){
            $patients = Patient::where('fist_name','LIKE', "%$request->fist_name%")->orderBy('fist_name', 'asc')->get();
      

        }
        else {
            $patients = Patient::where('fist_name','LIKE', "%$request->fist_name%")->orWhere('last_name','LIKE', "%$request->last_name%")->orderBy('fist_name', 'asc')->get();
           
        }
     
        session()->flash('flash.patients', $patients);
        return redirect()->back();
     }

     public function savepatient(Request $request){
       
        $newpatient =   Patient::create([
            'fist_name' => $request->fist_name,
            'last_name' => $request->last_name,
            'identification' => $request->identification,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'status' => 'true'
        ]);

        session()->flash('flash.patientnew', $newpatient);

        return redirect()->back();

     } 

     /**
      * filtro de busqueda en el index
      */

     public function filtersearch(Request $request){

        /**
         * metodo para observar la consulta sql de eloquent
         *  DB::enableQueryLog();  activa el log
         *  dd(DB::getQueryLog()); muestra la consulta
         */

       
        if (($request->filter == "patient") || ($request->filter == "employee" )){
            $first_name = "";
            $last_name = "";
            $search = explode(" ", $request->search);
            if (count($search) == 3 ){
                $first_name = $search[0]." ".$search[1];
                $last_name = $search[2];
            }
            if (count($search) == 2 ){
                $first_name = $search[0];
                $last_name = $search[1];
            }
            if (count($search) == 1 ){
                $first_name = $search[0];
            }

        }


        
        if ($request->filter == "patient"){
              
                $searchlist =  Consultation::with('branch','patient','employee')->select('*')
                ->join('patients', 'patients.id', '=', 'consultations.patient_id')
                ->where('patients.fist_name', 'LIKE',  '%'.$first_name.'%')
                ->where('patients.last_name', 'LIKE',  '%'.$last_name.'%')
                ->paginate(10);  
            }
    
        if ($request->filter == "employee"){
                $searchlist =  Consultation::with('branch','patient','employee')->select('*')
                ->join('employees', 'employees.id', '=', 'consultations.employee_id')
                ->where('employees.fist_name', 'LIKE',  '%'.$first_name.'%')
                ->where('employees.last_name', 'LIKE',  '%'.$last_name.'%')
                ->paginate(10);  
            }

        if ($request->filter == "date"){
                $searchlist = Consultation::with('branch','patient','employee')->where('date',$request->search)->orderBy('created_at', 'DESC')->paginate(10);

            }

            session()->flash('flash.listsearch', $searchlist);
            return redirect()->back();

     }

}
