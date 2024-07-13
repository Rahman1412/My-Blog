<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OptionsSetting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function pageSettigs(){
        return view("pages.admin-pages.page-settings");
    }

    public function addSetting(Request $request){
        $validator = Validator::make($request->all(),[
            "title" =>  "required",
            "slug"  =>  "required"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if($request->id && $request->id > 0){
            $setting = OptionsSetting::find($request->id);
        }else{
            $setting = new OptionsSetting();
        }

        $setting->title = $request->title;
        $setting->slug = $request->slug;
        $setting->content = $request->content;
        $setting->save();

        return response()->json(['success' => true], 200);
    }

    public function getSettings(Request $request){
        if($request->id && $request->id > 0){
            $data = OptionsSetting::find($request->id);
        }else{
            $data = OptionsSetting::get();
        }
        return response()->json(['success' => true, "data" => $data], 200);
    }

    public function deleteSetting(Request $request){
        $setting = OptionsSetting::find($request->id);
        $deleted = $setting->delete();
        return response()->json(['success' => true],200);
    }
}
