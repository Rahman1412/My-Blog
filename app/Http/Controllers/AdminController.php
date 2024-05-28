<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class AdminController extends Controller
{
    
    public function dashboard(){
        return view('pages.dashboard');
    }

    public function allBlogs(){
        return view('pages.all-blogs');
    }

    public function allCategory(){
        return view('pages.category');
    }

    public function addCategory(Request $request){
        $validator = Validator::make($request->all(),[
            "category" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $category = Category::create([
            'category' => $request->category,
        ]);
        if($category){
            return response()->json(['success' => 'Form submitted successfully!'],200);
        }
        return response()->json(['errors' => 'Unable to add category, Please try after sometimes'],400);
    }

    public function getCategory(){
        $category = Category::all();
        return response()->json(["success" => true,'message' => 'Category get successfully!','data' => $category],200);
    }
}
