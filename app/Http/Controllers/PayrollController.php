<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payroll;
use App\Models\Employee;
use App\Models\Payment_method; 
use App\Models\Method_type;
use App\Models\Consultation;
use App\Models\Package;
use App\Models\Service;
use App\Models\Payroll_detail;  
use App\Models\Payroll_pay;  



class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = Payroll::with('employee')->where('status','<>',false)->orderBy('created_at', 'DESC')->paginate(10);
        return inertia('Payrolls/index',['payrolls' => $payrolls]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $therapy = Service::where('id','1')->first();
        $employees = Employee::all();
        $payment_methods = Payment_method::with('method_type')->get();
     
        return inertia('Payrolls/create', [ 'employees' => $employees , 'payment_methods' => $payment_methods, 'therapy' => $therapy]);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request);
        $newpayroll =   Payroll::create([
            'employee_id' => $request->employee,
            'date' => $request->date,
            'amount' => $request->amount_pay,
            'concept' => $request->concept,
            'status' => $request->status,
        ]);

        $detailPayroll = $request->payrollsDetails;
        if (isset($detailPayroll)){
            foreach ($detailPayroll as $detail) {

                $consultation = Consultation::where('id', $detail['consultation_id'])->first();
                $consultation->status_payroll = true;
                $consultation->update();

                $detail_payroll =   Payroll_detail::create([
                    'payroll_id' => $newpayroll->id,
                    'consultation_id' => $detail['consultation_id'],
                    'amount' => $detail['amount'],
                ]);
            }
         }

        $file = $request->capture;
        $url_capture = "";
        if (isset($file)){
            $fileOriginalName = $file->getClientOriginalName();
            $fileDestinationPath = "captures/";
            $fileNAme = time(). "-".$fileOriginalName;
            $upLoadSuccess = $file->move($fileDestinationPath, $fileNAme);
           $url_capture =  $fileDestinationPath.$fileNAme;
        }
        $payroll_pay = Payroll_pay::create([
            'payroll_id' => $newpayroll->id,
            'payment_method_id' => $request->payment_methods_id,
            'amount' => $request->amount_pay,
            'reference' => $request->reference,
            'url_capture' => $url_capture,
        ]);

        return redirect()->route('payrolls.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payroll = Payroll::with('employee')->where('id',$id)->first();
        $payrollDetail = Payroll_detail::with('consultation')->where('payroll_id',$payroll->id)->get();
        $payrollPay = Payroll_pay::with('payment_method')->where('payroll_id',$payroll->id)->first();
        $typemethods = Method_type::all();

        return inertia('Payrolls/show', [ 'payroll' => $payroll , 'payrollDetail' => $payrollDetail, 'payrollPay' => $payrollPay, 'typemethods' => $typemethods]);
    
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
    public function destroy(Request $request)
    {
        //dd($request);
       // $payroll = Payroll::with('employee')->where('id',$id)->first();
        $employee = Employee::where('id',$request->employee)->first();
        $payrollDetail = Payroll_detail::where('payroll_id',$request->payroll)->get();
        if (isset($payrollDetail)){
            foreach ($payrollDetail as $detail) {
                $consultation = Consultation::where('id', $detail['consultation_id'])->first();
                $consultation->status_payroll = false;
                $consultation->update();

                $deletedetail = Payroll_detail::where('id',$detail['id'])->delete();
            }
        }

        $payrollPay = Payroll_pay::where('payroll_id',$request->payroll)->delete();
        $payroll = Payroll::where('id',$request->payroll)->delete();
        
        return redirect()->route('payrolls.index');
    }  

    public function searchworked(Request $request){
        $consultations = Consultation::where('employee_id', $request->employee)->where('status','REALIZADA')->where('status_payroll',false)->get();
        session()->flash('flash.consultations', $consultations);
        return redirect()->back();
    }
}
  