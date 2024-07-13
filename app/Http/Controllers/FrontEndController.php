<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OptionsSetting;

class FrontEndController extends Controller
{
    public function viewHome(Request $request){
        return view('pages.user-pages.home');
    }

    public function viewAboutUs(){
        $data = OptionsSetting::where("slug","about-us")->first();
        return view("pages.user-pages.about-us",compact('data'));
    }
}
