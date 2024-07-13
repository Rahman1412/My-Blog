<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Menus;

class MenuController extends Controller
{
    
    public function allMenus(){
        return view('pages.admin-pages.all-menu');
    }

    public function newMenu(Request $request){
        $validator = Validator::make($request->all(),[
            "menu" => "required",
            "slug" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        if($request->id && $request->id > 0){
            $menu = Menus::find($request->id);
            $message = "Menu updated successfully!!";
        }else{
            $menu = new Menus();
            $message = "Menu created successfully!!";
        }
        
        $menu->name  = $request->menu;
        $menu->slug  = $request->slug;
        $menu->status = $request->status;
        $menu->save();

        if($menu){
            return response()->json(['success' => true,"message" => $message], 200);
        }

        return response()->json(['errors' => "Something went wrong,please try after sometimes"], 400);
    }

    public function getMenu(){
        $menus = Menus::orderBy('id', 'DESC')->get();
        return response()->json(['success' =>  true,'data' => $menus], 200);
    }

    public function deleteMenu(Request $request){
        $menu = Menus::find($request->id);
        $deleted = $menu->delete();
        if($deleted){
            return response()->json(['success' =>  true,"message" => "Menu Deleted Successfully!!"], 200);
        }
        return response()->json(['success' =>  false,"message" => "Unable to delete menu, Please try after sometimes"],403);
    }
}
