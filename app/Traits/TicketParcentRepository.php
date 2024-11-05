<?php

namespace App\Traits;

use App\Models\TicketPercent;
use GuzzleHttp\Psr7\Request;

trait TicketParcentRepository
{
    public function all()
    {
        $ticketparcent = TicketPercent::with('Airline')->
        select('airline_id', 'domestic', 'inbound', 'outbound', 'inland', 'soto', 'service_charge', 'domestic_service_charge')
        ->get();
        return json_decode(json_encode($ticketparcent));
    }
}