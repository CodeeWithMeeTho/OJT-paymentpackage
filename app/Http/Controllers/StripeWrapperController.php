<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use StripeWrapper\StripeWrapperLaravel\StripeMain;

class StripeWrapperController extends Controller
{
    public function payment(Request $request)
    {
        $param = [
            "cvc" => $request["cvc"], //Required
            "cardNumber" => $request["cardNumber"], //Required
            "expiryMonth" =>  $request["expiryMonth"], //Required
            "expiryYear" =>  $request["expiryYear"], //Required
            "description" => "Payment", // Change according to your description
            "amount" => $request["amount"], //Required
            "isPayment" => true, //Required
            "items" => [] // For multiple items (optional)
        ];

        return response()->json(StripeMain::process($param));
    }
}
