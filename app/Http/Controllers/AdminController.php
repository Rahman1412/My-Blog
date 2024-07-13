<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blogs;
use App\Models\Technologies;

class AdminController extends Controller
{
    
    public function dashboard(){
        return view('pages.admin-pages.dashboard');
    }

    public function allBlogs(){
        $blogs = Blogs::all();
        $tags = Technologies::all();
        return view('pages.admin-pages.all-blogs',compact('blogs','tags'));
    }
}
