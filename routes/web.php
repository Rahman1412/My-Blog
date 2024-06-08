<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EditorController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin-dashboard');
Route::get('/blogs',[AdminController::class,'allBlogs'])->name('blogs');



Route::get('/category',[AdminController::class,'allCategory'])->name('category');
Route::post('/add-category',[AdminController::class,'addCategory'])->name('add_category');
Route::get('/get-category',[AdminController::class,'getCategory'])->name('get_category');
Route::get('/delete-category',[AdminController::class,'deleteCategory'])->name('delete_category');


Route::get('/new-blog',[BlogController::class,'newBlog'])->name('new_blog');
Route::post('/saveBlog',[BlogController::class,'saveBlog'])->name('saveBlog');
Route::get('/getBlogs',[BlogController::class,'getBlogs'])->name('getBlogs');
Route::get('/deleteBlog',[BlogController::class,'deleteBlog'])->name('deleteBlog');

Route::post('/upload',[EditorController::class,'uploadMedia'])->name('ckeditor.upload');
