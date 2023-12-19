<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function getSession(Request $request)
    {

        $paypalSecretKey = config('services.paypal.secret');

        return response()->json([
            'paypalSecretKey' => $paypalSecretKey,
        ], 200);

    }
}
