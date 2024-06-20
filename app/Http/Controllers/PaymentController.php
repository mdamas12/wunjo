<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest; 
use App\Http\Requests\Payment_detailRequest;
use Illuminate\Http\Response;
use Inertia\Inertia;
use App\Models\Payment;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Package;
use App\Models\Payment_method; 
use App\Models\Method_type;
use App\Models\Payment_detail;   
use App\Models\Payment_check;  


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::where('status','<>','DELETED')->orderBy('created_at', 'DESC')->paginate(10);
        $payments->load('patient');
        return inertia('Payments/index',['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        $payment_methods = Payment_method::all();
        $payment_methods->load('method_type');

        return inertia('Payments/create', [ 'patients' => $patients , 'payment_methods' => $payment_methods]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
      
      //Crear el pago 
        $payment = Payment::create($request->validated());
        if (isset($payment)){
          //agregar los detalles 
          if (isset($request->consultaDetails)){
                foreach ($request->consultaDetails as $detail) {
                    //dd($detail['cosultation_id']);
                    $detail['payment_id'] = $payment->id;
                    $consultation_detail = new Payment_detailRequest;
                    $consultation_detail = $detail;
                    Payment_detail::create($consultation_detail);
                    $consultatiom = Consultation::where('id',$detail['consultation_id'])->first();
                    //$consultatiom->status_payment = $request->status_payment;
                    $sumTotal = $consultatiom->amount_paid + $detail['amount_payable'];
                  
                    if ($sumTotal ==  $consultatiom->amount ){
                        $consultatiom->status_payment = "PAID";
                    }
                    if ($sumTotal == 0){
                        $consultatiom->status_payment = "PENDIENTE";
                    }
                    if (($sumTotal < $consultatiom->amount ) && ($sumTotal != 0)){
                        $consultatiom->status_payment = "PARTIAL";
                    }
                    $consultatiom->amount_paid = $sumTotal;
                    $consultatiom->update();                    
                 }
            }  
           if (isset($request->packagesDetails)){ 
                foreach ($request->packagesDetails as $detail) {
                    $detail['payment_id'] = $payment->id;
                    $package_detail = new Payment_detailRequest;
                    $package_detail = $detail;
                    Payment_detail::create($package_detail);
                    $package = Package::where('id',$detail['package_id'])->first();
                    $package->load('service');
                    //$package->service['price'];
                    $sumTotal = $package->amount_paid + $detail['amount_payable'];
                  
                    if ($sumTotal ==  $package->service['price']){
                        $package->status_payment = "PAID";
                    }
                    if ($sumTotal == 0){
                        $package->status_payment = "PENDIENTE";
                    }
                    if (($sumTotal < $package->service['price'] ) && ($sumTotal != 0)){
                        $package->status_payment = "PARTIAL";
                    }
                    $package->amount_paid = $sumTotal;
              
                    $package->update();
                }
          }
         //Agregar los pagos parciales
         $pay_ckecks = $request->partialPayments;
         if (isset($pay_ckecks)){ 

            foreach ($pay_ckecks as $cheks) {
                $file = $cheks['file_reference'];
                $url_capture = "";
                if (isset($file)){
                    $fileOriginalName = $file->getClientOriginalName();
                    $fileDestinationPath = "captures/";
                    $fileNAme = time(). "-".$fileOriginalName;
                    $upLoadSuccess = $file->move($fileDestinationPath, $fileNAme);
                   $url_capture =  $fileDestinationPath.$fileNAme;
                }
                $data = [
                    
                    "payment_id" => $payment->id,
                    "payment_method_id" => $cheks["method_pay"]["id"],
                    "parcial_amount" => $cheks["parcial_amount"], 
                    "reference" => $cheks["reference"],
                    "url_capture" => $url_capture,
                ];
                    $checked_pay  = new Payment_check;
                    $checked_pay = $data;
                    Payment_check::create($checked_pay);
                
            }
         }
          
            return redirect()->route('payments.index');
        }
        else{
            return redirect()->back();
        }

        
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

    public function search_consultation(Request $request){
        //$data = $request;
        $patient_id = $request->patient;
        $consultations = Consultation::with('patient','employee')
                        ->where('patient_id',$patient_id)
                        ->where('status_payment','<>','PAID')
                        ->where('amount','>','0')->get();

                        
        $packages = Package::with('patient','service')->where('patient_id',$patient_id)->where('status_payment', '<>','PAID')->get();
        
        session()->flash('flash.consultations', $consultations);
        session()->flash('flash.packages', $packages);
        return redirect()->back();
    
    }


    public function servicespayment(Request $request){
    //dd($request->payment_id);
       $paymentServices = Payment_detail::with('consultation','package')->where('payment_id','=', $request->payment_id)->get();
       $paymentDetail = Payment_check::with('payment_method')->where('payment_id','=', $request->payment_id)->get();
     
       session()->flash('flash.serviceslistpayment', $paymentServices);
       session()->flash('flash.paymentDetailList', $paymentDetail);
       return redirect()->back();
       

    }

    public function deletepayment(Request $request) {
        /* datos de los detallles */
        $detailpayment = Payment_detail::where('payment_id','=', $request->payment_id)->get();
        /* Eliminar d ela bd los detalle */ 
        //dd($request->payment_id);
        $resultDeleteDetail = Payment_detail::where('payment_id',$request->payment_id)->delete(); 
        if ($resultDeleteDetail > 0){
            if (isset($detailpayment)){
                foreach ($detailpayment as $detail) {
                    if ($detail['consultation_id'] != null){
                        $consultation = Consultation::where('id','=', $detail['consultation_id'])->first(); 
                        if($consultation){
                            $consultation->amount_paid = $consultation->amount_paid - $detail['amount_payable'];
                            if ($consultation->amount_paid ==  $consultation->amount ){
                                $consultation->status_payment = "PAID";
                            }
                            if ($consultation->amount_paid  == 0){
                                $consultation->status_payment = "PENDIENTE";
                            }
                            if (($consultation->amount_paid  < $consultation->amount ) && ($consultation->amount_paid  != 0)){
                                $consultation->status_payment = "PARTIAL";
                            }
                            $consultation->update(); 
                        }
                    }
                    else{
                       $package = Package::with('service')->where('id', $detail['package_id'])->first();
                       
                       if ($package){
                        $rest = $package->amount_paid - $detail['amount_payable'];
    
                        if ($rest ==  $package->service['price']){
                            $package->status_payment = "PAID";
                        }
                        if ($rest == 0){
                            $package->status_payment = "PENDIENTE";
                        }
                        if (($rest < $package->service['price'] ) && ($rest != 0)){
                            $package->status_payment = "PARTIAL";
                        }
                        $package->amount_paid = $rest;
                  
                        $package->update();
    
                       }
                    }
    
                }
            }
    
        }
        else{
            session()->flash('flash.message', "ha ocurrido un error al intentar eliminar el pago 1");
            return redirect()->back();
        } 
         $ResultDeletChecks = Payment_check::where('payment_id',$request->payment_id)->delete(); 
        
         if ($ResultDeletChecks > 0){
            $paymentDelete = Payment::where('id',$request->payment_id)->delete();

            if($paymentDelete > 0){
                session()->flash('flash.message', "Pago ha sido eliminado con exito");
                return redirect()->back(); 
            }
            else{
                session()->flash('flash.message', "ha ocurrido un error al intentar eliminar el pago 2");
                return redirect()->back();
            }
         } 
         else{
            session()->flash('flash.message', "ha ocurrido un error al intentar eliminar el pago 3");
            return redirect()->back();
         }
      
    }


}
