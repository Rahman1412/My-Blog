<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blogs;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function newBlog(){
        $category = Category::all();
        return view('pages.new-blog',compact('category'));
    }

    public function getBlogs(){
        $blogs = Blogs::orderBy('id','desc')->paginate(5);
        return response()->json(["success" => true,"data" => $blogs], 200);
    }

    public function deleteBlog(Request $request){
        $id = $request->id;
        if($id){
            $delete = Blogs::find($id)->delete();
            return response()->json(["success" => true, "message" => "Blog deleted successfully"], 200);
        }
        return response()->json(["error" => true, "message" => "Unable to delete blog, Please try after sometimes"], 400);
    }

    public function saveBlog(Request $request){

        $validator = Validator::make($request->all(),[
            "title" => "required",
            "slug" => "required",
            "short_desc" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $blog = new Blogs();
        if ($image = $request->file('thumbnail')) {
            $destinationPath = 'thumbnail/';
            $fileName = $image->getClientOriginalName();
            $extension = pathinfo($fileName,PATHINFO_FILENAME);
            $thumbnailImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $thumbnailImage);
            $url = asset('thumbnail/'.$thumbnailImage);
            $blog->thumbnail = $url;
        }
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->category = $request->category;
        $blog->status = $request->status;
        $blog->short_desc = $request->short_desc;
        $blog->save();
        $message = "Blog saved successfully!!";

        if($blog){
            return response()->json(['success' => true,"message" => $message],200);
        }
        return response()->json(['errors' => 'Unable to create blog, Please try after sometimes'],400);
    }
}
