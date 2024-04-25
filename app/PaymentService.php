<?php

namespace App;

use Illuminate\Http\Request;

interface PaymentService
{
    public function createPayment(Request $request);

    public function createUser($request, $paymentReference, $response);
}
