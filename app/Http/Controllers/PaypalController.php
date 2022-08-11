<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PaypalWrapper\PaypalWrapperLaravel\PaypalMain;

class PaypalController extends Controller
{
    public function payment(Request $request)
    {

      

        if ($request->all()) {

            $param = [
                "paymentID" => $request->all()['paymentID'],
                "payerID" => $request->all()['payerID'],
                "process" => "Success", // Can be Payment, Success, Cancel, case-sensitive
                "optionName" => "PAYPAL",
            ];

            return PaypalMain::process($param);

        } else {

            $param =  [
                "optionId" => 1,
                "optionName" => "PAYPAL",
                "name" => "Jifford R. Romasanta",
                "tax" => 0.00,
                "shipping" => 0.00,
                "description" => "AutoBotz Payment",
                "paymentIntent" => "sale",
                "process" => "Payment", // Can be Payment, Success, Cancel, case-sensitive
                "items" => [
                    [
                        "itemName" => "Car Loan",
                        "price" => 0,
                        "desc" => "Downpayment for Toyota car.",
                        "qty" => 1,
                        "discount" => 0,
                        "isDiscPercentage" => false
                    ],
                    [
                        "itemName" => "Housing Loan",
                        "price" => 0,
                        "desc" => "Downpayment for Condo unit.",
                        "qty" => 1,
                        "discount" => 0,
                        "isDiscPercentage" => false
                    ]
                ]
            ];

            return PaypalMain::process($param);
        }
    }
}
