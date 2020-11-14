<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts(){
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
          );

        return $stripe->products->all();
    }
}
