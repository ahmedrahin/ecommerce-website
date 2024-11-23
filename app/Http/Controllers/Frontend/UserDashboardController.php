<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Auth;

class UserDashboardController extends Controller
{
    public function dashboard(){
        $user = User::find(Auth::id());
        return view('frontend.pages.user.dashboard', compact('user'));
    }

    public function invoice($order_id){
        $order = Order::where('id', $order_id)->first();
        return view('frontend.pages.user.invoice', compact('order'));
    }
}
