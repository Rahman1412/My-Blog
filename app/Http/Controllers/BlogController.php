<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Facades\Validator;
use App\Models\BlogMetadata;
use App\Models\Technologies;

class BlogController extends Controller
{
    public function newBlog(Request $request){
        $blog = Blogs::find($request->id);
        $tags = Technologies::all();
        return view('pages.admin-pages.new-blog',compact('tags','blog'));
    }

    public function getBlogs(){
        $blogs = Blogs::orderBy('id','desc')->paginate(5);
        $blogs->getCollection()->map(function ($blog) {
            if ($blog->tags) {
                $blog->tags = unserialize($blog->tags);
            }
            return $blog;
        });
        
        return response()->json(["success" => true,"data" => $blogs], 200);
    }

    public function deleteBlog(Request $request){
        $id = $request->id;
        $blog = Blogs::find($id);
        if($id){
            if ($blog->meta) {
                $blog->meta->delete();
            }
            $delete = Blogs::find($id)->delete();
            return response()->json(["success" => true, "message" => "Blog deleted successfully"], 200);
        }
        return response()->json(["error" => true, "message" => "Unable to delete blog, Please try after sometimes"], 400);
    }

    public function viewBlog(Request $request){
        $id = $request->id;
        $blog = Blogs::find($id);
        $blog->tags = ($blog->tags && count(unserialize($blog->tags)) > 0) ? unserialize($blog->tags) : null;
        return response()->json(["success" => true, "message" => "Blog get successfully","data" =>$blog ], 200);
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
        
        if($request->id > 0){
            $blog = Blogs::find($request->id);
        }else{
            $blog = new Blogs();
        }
        
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
        $blog->tags = ($request->tags && count($request->tags) > 0) ? serialize($request->tags) : null;
        $blog->status = $request->status;
        $blog->short_desc = $request->short_desc;
        $blog->save();
        $message = "Blog saved successfully!!";

        if($blog){
            return response()->json(['success' => true,"message" => $message],200);
        }
        return response()->json(['errors' => 'Unable to create blog, Please try after sometimes'],400);
    }


    public function saveMetaData(Request $request){
        if($request->id > 0){
            $meta = BlogMetadata::find($request->id);
            
        }else{
            $meta = new BlogMetadata();
            
        }
        $meta->blog_id = $request->blog_id;
        $meta->title = $request->title;
        $meta->status = $request->status;
        $meta->description = $request->content;
        $metadata = $meta->save();
        return response()->json(['success' => true,"message" => "Blog Meta Data Saved Successfully!!"],200);
    }

    function getMetaData(Request $request){
        $id = $request->id;
        $blog = Blogs::with('meta')->find($id);
        return response()->json(['success' => true,"data" => $blog],200);
    }
}
