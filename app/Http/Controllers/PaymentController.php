<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use App\Payment;
use App\Iborseminar;
use App\Mail\IborDonations;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        
        ['status' => $status, 'message' => $message, 'data' => ['customer' => $customer, 'authorization' => $authorization] ] = $paymentDetails;
        // dd($customer['email']);
         
        if($message === 'Verification successful') {
            $saveData = new Payment;
            $ref = $customer['id'];
         $saveData-> ref_id = $customer['id'];
         $saveData-> first_name = $customer['first_name'];
         $saveData-> last_name = $customer['last_name'];
         $saveData-> customer_email = $customer['email'];
         $saveData-> customer_code = $customer['customer_code'];
         $saveData-> authorization_code = $authorization['authorization_code'];
         $saveData->save();
        
         
         
            $check = Iborseminar::where('email', $customer['email'])->count();

            $check >= 1 ? Iborseminar::where('email', $customer['email'])->update(array('status' => '0')) : null;
            
            if($saveData) {               
                $ref = $customer['id'];

                $sendmail = new IborDonations($saveData);
                \Mail::to($customer['email'])->send($sendmail);
                $msg = 'Transaction successful';
                return redirect("/payment-confirmation/$msg");
               // return redirect("/payment-confirmation/ref=$ref?msg=$msg");
            }

        } else {
            $msg = "Transaction failed";
            return redirect('/payment-confirmation');
        }
         
        
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}