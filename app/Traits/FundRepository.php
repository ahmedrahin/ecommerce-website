<?php

namespace App\Traits;

use App\Models\Fund;
use GuzzleHttp\Psr7\Request;

trait FundRepository
{
    public function saveFund($fundData){

        $fund = new Fund;

        $fund->ota                          = $fundData['ota'];
        $fund->admin_fund_id                = $fundData['admin_fund_id'];
        $fund->fund_type                    = $fundData['fund_type'];
        $fund->payment_method_id            = $fundData['payment_method_id'];
        $fund->amount                       = $fundData['amount'];
        $fund->deposit_slip                 = $fundData['deposit_slip'];
        $fund->remarks                      = $fundData['remarks'];
        $fund->status                       = $fundData['status'];

        $fund->save();
        
        return $fund;
    }

}