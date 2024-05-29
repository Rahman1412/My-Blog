<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin-dashboard');
Route::get('/blogs',[AdminController::class,'allBlogs'])->name('blogs');

Route::get('/category',[AdminController::class,'allCategory'])->name('category');

Route::post('/add-category',[AdminController::class,'addCategory'])->name('add_category');
Route::get('/get-category',[AdminController::class,'getCategory'])->name('get_category');
Route::get('/delete-category',[AdminController::class,'deleteCategory'])->name('delete_category');
