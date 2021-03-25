<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree;
use App\Order;
use Session;

class PaymentController extends Controller
{
    public function checkout(Request $request){ 
        //dd($request);
       $gateway = new Braintree\Gateway([             
           'environment' => "sandbox",             
           'merchantId' => "4fpx4bjjrdctfz3r",             
           'publicKey' => "r8hvpqpv3xgpv47j",             
           'privateKey' => "a44196b0529e5a5dc1695e3d8336f933"         
        ]);  

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
                'amount' => $amount,
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

        if ($result->success) {
            $transaction = $result->transaction;
            $successMessage = "Transation successful. The ID is:" . $transaction->id;

            //updato l'order
            $newOrder = Session::has("newOrder") ? Session::get("newOrder") : null; 
            $newOrder->isPayed = true;
            $newOrder->save();
            //dd($newOrder);
            return view('result',compact('successMessage'));
            /* return view('result')->with("success_message", "Transation successful. The ID is:" . $transaction->id); */
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return view('result')->withErrors("An error occurred with the message:" .$result->message);
        
        }}  
    }
            
