<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blogs;

class BlogController extends Controller
{
    public function newBlog(){
        $category = Category::all();
        return view('pages.new-blog',compact('category'));
    }

    public function saveBlog(Request $request){
        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->short_desc = $request->short_desc;
        $blog->save();
        $message = "Blog saved successfully!!";

        if($blog){
            return response()->json(['success' => true,"message" => $message],200);
        }
        return response()->json(['errors' => 'Unable to create blog, Please try after sometimes'],400);
    }
}
