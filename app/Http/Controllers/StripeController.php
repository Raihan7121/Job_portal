<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

use Illuminate\Http\RedirectResponse;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
class StripeController extends Controller
{
    
    public function checkout(Request $request){

        $quantities = $request->input('quantities');
        $totalbill = $request->input('total_bill');
        $encodedQuantities = json_encode($quantities);

        if( $totalbill<=0 ){
            return redirect()->back()->with('error', 'no item is selected');
            
        }

       // Stripe::setApiKey()
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'gbp',
                        'product_data' => [
                            'name' => 'Send me money!!!',
                        ],
                        'unit_amount'  => $totalbill*100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success',['quantities' => $encodedQuantities]),
            'cancel_url'  => route('index'),
        ]);
        
        //dd($session->url);

        return redirect()->away($session->url);
    }
  
   
}
