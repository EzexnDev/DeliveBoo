<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Braintree\Gateway;

class CheckoutController extends Controller
{
    public function checkout()
    {

        $finalPrice = '';

       
        $finalPrice = $_COOKIE['cookieAmount'];
        /* dd($finalPrice); */
        return view('checkout',compact('finalPrice'));
       

        
    }
}
