<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iborseminar;
use App\Payment;
use App\Mail\ConfirmationMail;
use App\Feedback;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SeminarExport;

use Validator;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     /*   $lastRegCode = Iborseminar::latest()->orderBy('id', 'desc')->first();

        $extratCode = explode('-', $lastRegCode->reg_code);
        
       if(strlen($extratCode[1]+1) == 2 ) {
            $codeInit = '#IB7-0';
       } else 
       if(strlen($extratCode[1]+1) > 2)
       {
            $codeInit = '#IB7-';
       } else 
       if(strlen($extratCode[1]+1) < 2) {
            $codeInit = '#IB7-00';
       }
        $newRegCode = $codeInit.$extractCode = $extratCode[1]+1;
        return dd($newRegCode);*/
       // return dd(strlen($extratCode[1]+1) == 2 ? 'Yes' : 'No');
        return view('login.index');
    }

    public function payNow() {
        return view('payment.paynow');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ],
         [
             'fname.required' => 'First name required',
             'lname.required' => 'Last name required',
             'email.required' => 'Email is required',
             'phone.required' => 'Phone number is required',
         ]);

         if($rules->fails()) {
             return response()->json(['errors' => $rules->errors()->all()]);
         } else {
             $checkDoubleReg = Iborseminar::where('email', $request->email)->count();
             if($checkDoubleReg >= 1) {
                 return response()->json(['exists' => 'You already booked a seat for this event']);
             } else {
                 $status = '1';
                 $addReg = new Iborseminar;
                 $addReg-> reg_code = $addReg->codeGenerator();
                 $addReg-> fname = $request->fname;
                 $addReg-> lname = $request->lname;
                 $addReg-> phone_number = $request->phone;
                 $addReg-> email = $request->email;
                 $addReg-> occupation = $request->occupation;
                 $addReg-> address = $request->address;
                 $addReg-> status = $status;
                 $addReg->save();

                $sendmail = new ConfirmationMail($addReg);

                \Mail::to($request->email)->send($sendmail);
                 return response()->json(['success' => 'Registration successful, please check your mailbox form confirmation']);
             }
         }
    }
     
    public function seminarDonation() {
        return view('seminar.donation');
    }
    public function paymentConfirmation($msg) {
       // $payment = Payment::where('customer_id', $customer_id);
       // if($payment) {
          // $msg = "Transaction successful"; 
          return redirect('/');          
           // return view('payment.paymentConfirmation')->with('msg', $msg);
       /* } else {

        }*/
        
    }

    public function sendMail(Request $request, $user_id) {
        $send = new Iborseminar;

       return $send->sendIborMail($request, $user_id);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function feedback(Request $request) {

        $save = new Iborseminar;
        return $save->feedback($request);
    }

    public function export() {
        return Excel::download(new SeminarExport, 'Registration list.xlsx');
    }
}
