<?php

namespace App\Traits;

use App\Models\Airline;
use GuzzleHttp\Psr7\Request;

trait AirlineRepository
{
    public function all()
    {
        $airlines = Airline::get();
        return json_decode(json_encode($airlines));
    }
}