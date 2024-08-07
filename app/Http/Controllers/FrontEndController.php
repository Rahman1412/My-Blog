<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OptionsSetting;
use App\Models\Blogs;

class FrontEndController extends Controller
{
    public function viewHome(Request $request){
        $blogs = Blogs::where('status','public')->orderBy('id', 'DESC')->paginate(10);
        return view('pages.user-pages.home',compact("blogs"));
    }

    public function viewAboutUs(){
        $data = OptionsSetting::where("slug","about-us")->first();
        return view("pages.user-pages.about-us",compact('data'));
    }

    public function viewContactUs(){
        return view("pages.user-pages.contact-us");
    }

    public function viewBlog(Request $request){
        $id = $request->id;
        $slug = $request->slug;
        $blog = Blogs::find($id);
        return view("pages.user-pages.view-blog",compact('blog'));
    }
}
