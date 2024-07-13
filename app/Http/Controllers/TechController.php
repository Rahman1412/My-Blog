<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technologies;
use Illuminate\Support\Facades\Validator;

class TechController extends Controller
{
    public function allTechnologies(){
        return view("pages.admin-pages.all-technologies");
    }

    public function getTechnologies(){
        $technologies = Technologies::all();
        return response()->json(['success' => true,"message" => "All data get successfully!","data" => $technologies],200);
    }

    public function addTechnologies(Request $request){
        $rule = [
            "technology" => "required",
            "slug"       => "required",
            "status"     => "required",
        ];
        if(!$request->id || $request->id == 0){
            $rule["logo"] = "required|mimes:jpeg,png,jpg,gif";
        }
        $validator = Validator::make($request->all(),$rule);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if ($image = $request->file('logo')) {
            $destinationPath = 'tech-logo/';
            $fileName = $image->getClientOriginalName();
            $extension = pathinfo($fileName,PATHINFO_FILENAME);
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $url = asset('tech-logo/'.$profileImage);
        }
        if(!$request->id || $request->id == 0){
            $technologies = new Technologies();
            $technologies->logo = $url;
            $message = "Data saved successfully!";
        }else{
            $technologies = Technologies::find($request->id);
            $technologies->logo = $technologies->logo;
            $message = "Data updated successfully!";
        }
        $technologies->name = $request->technology;
        $technologies->slug = $request->slug;
        $technologies->status = $request->status;
        $technologies->save();
        
        return response()->json(['success' => true,"message" => $message],200);
    }

    public function deleteTechnology(Request $request){
        $id = $request->id;
        $technology = Technologies::find($id);
        $deleted = $technology->delete();
        if($deleted){
            return response()->json(['success' => true,"message" => "Data deleted successfully!"],200);
        }
        return response()->json(['success' => false,"message" => "Unable to delete, Please try after sometimes!"],400);
    }
}
