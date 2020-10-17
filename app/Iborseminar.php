<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\ConfirmationMail;
use App\Feedback;
use Validator;

class Iborseminar extends Model
{
    public function codeGenerator() {
        $lastRegCode = self::latest()->orderBy('id', 'desc')->first();
       
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

        return $newRegCode;
    }

    public function sendIborMail($request, $user_id) {
        $getUser = self::find($user_id);

        if($request->ajax()) {
          if($getUser->email === ' ') {
            return response()->json(['error' => 'Error sending mail']);
          }

          $send = new ConfirmationMail($getUser);
          \Mail::to($getUser->email)->send($send);
          return response()->json(['success' => 'Mail sent']);
        }

        return response()->json(['success' => $getUser]);
          

    }

    public function feedback($request) {

      $validator = Validator::make($request->all(), [
       // 'reason' => 'required',
       // 'about' => 'required',
        'gender' => 'required',
        'age' => 'required',
        'nextedition' => 'required',
      ]);

       if($validator->fails()) {
        return response()->json(['error' => 'All filed are required']);
       }

      $save = new Feedback;

      if($request->ajax()) {


        $save-> about_us = $request->about;
        $save-> reason = $request->reason;
        if($request->reason == 'null') {
          $save-> reason = $request->reasons;
        }
        if($request->about == 'null') {
          $save-> about_us = $request->abouts;
        }        
        $save-> gender = $request->gender;
        $save-> age_group = $request->age;
        $save-> available_next =$request->nextedition;
        $save-> status = '1';
        $save->save();

          if($save) {
              return response()->json(['success' => 'Feedback submitted']);
          }

         // return response()->json(['success' => $request->all()]);
      }
  }
}
