<?php

namespace App\Traits;

use App\Models\Order;
use GuzzleHttp\Psr7\Request;

trait OrderRepository
{
    public $columnsDefault = [
        'OrderID' => true,
        'OtaID' => true,
        'UserID' => true,
        'Api'  => true,
        'Pnr' => true,
        'Route'  => true,
        'Airlines' => true,
        'FlightDate' => true,
        'PaxDetails' => true,
        'Actions' => true,
    ];
    public function filterArray($array, $allowed = [])
    {
        return array_filter(
            $array,
            function ($val, $key) use ($allowed) { // N.b. $val, $key not $key, $val
                return isset($allowed[$key]) && ($allowed[$key] === true || $allowed[$key] === $val);
            },
            ARRAY_FILTER_USE_BOTH
        );
    }

    public function filterKeyword($data, $search, $field = '')
    {
        $filter = '';
        if (isset($search['value'])) {
            $filter = $search['value'];
        }
        if (!empty($filter)) {
            if (!empty($field)) {
                if (strpos(strtolower($field), 'date') !== false) {
                    // filter by date range
                    $data = $this->filterByDateRange($data, $filter, $field);
                } else {
                    // filter by column
                    $data = array_filter($data, function ($a) use ($field, $filter) {
                        return (bool) preg_match("/$filter/i", $a[$field]);
                    });
                }
            } else {
                // general filter
                $data = array_filter($data, function ($a) use ($filter) {
                    return (bool) preg_grep("/$filter/i", (array) $a);
                });
            }
        }
        return $data;
    }

    public function filterByDateRange($data, $filter, $field){
        // filter by range
        if (!empty($range = array_filter(explode('|', $filter)))) {
            $filter = $range;
        }
        if (is_array($filter)) {
            foreach ($filter as &$date) {
                // hardcoded date format
                $date = date_create_from_format('m/d/Y', stripcslashes($date));
            }
            // filter by date range
            $data = array_filter($data, function ($a) use ($field, $filter) {
                // hardcoded date format
                $current = date_create_from_format('m/d/Y', $a[$field]);
                $from    = $filter[0];
                $to      = $filter[1];
                if ($from <= $current && $to >= $current) {
                    return true;
                }
                return false;
            });
        }
        return $data;
    }

    public function all()
    {
        $orders = Order::get();

        foreach ($orders as $key => &$item) {

            $bookingDataParts = explode("-", $item["booking_data"]);
            
            $item["OrderID"]    = $bookingDataParts[0];
            $item["OtaID"]      = $bookingDataParts[2];
            $item["UserID"]     = $bookingDataParts[3];
            $item["Api"]        = $bookingDataParts[4];
            $item["Pnr"]        = $bookingDataParts[5];
            $item["Route"]      = $bookingDataParts[5];
            $item["Airlines"]   = $bookingDataParts[5];
            $item["FlightDate"] = $bookingDataParts[5];
            $item["PaxDetails"] = $bookingDataParts[5]; 
            $item["Actions"]    = "null";

            unset($item["id"]);
            unset($item["booking_data"]);
            unset($item["created_at"]);
            unset($item["updated_at"]);
        }
        return json_decode(json_encode($orders));
    }

    public function saveOrder($orderData){

        $order = new Order;
        $order->booking_data=$orderData['booking'];
        $order->save();
        return $order;
    }

    public function getOrderByString($date){
        $orders = Order::select('booking_data')->where('booking_data','LIKE', '%'.$date.'%')->get();
        return json_decode(json_encode($orders));
    }
    function removeAllSpace($string){
        $str = str_replace(' ', '', $string);
        return $str;
    }

}