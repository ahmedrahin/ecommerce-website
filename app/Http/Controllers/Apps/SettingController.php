<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function manage(){
        return view('pages.apps.setting.genarel');
    }

    public function website_setting(){
        return view('pages.apps.setting.website');
    }
}
