<?php

namespace App\Traits;

use App\Models\PaymentMethods;
use GuzzleHttp\Psr7\Request;

trait BankDetailsRepository
{
    public function all()
    {
        $bankDetails = PaymentMethods::get();
        return json_decode(json_encode($bankDetails));
    }
}