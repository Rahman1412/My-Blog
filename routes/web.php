<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TechController;
use App\Http\Controllers\SettingController;


Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('pages.admin-pages.dashboard');
    });
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin-dashboard');
    Route::get('/blogs',[AdminController::class,'allBlogs'])->name('blogs');

    
    
    Route::get('/new-blog/{id}',[BlogController::class,'newBlog'])->name('new_blog');
    Route::post('/saveBlog',[BlogController::class,'saveBlog'])->name('saveBlog');
    Route::get('/getBlogs',[BlogController::class,'getBlogs'])->name('getBlogs');
    Route::get('/deleteBlog',[BlogController::class,'deleteBlog'])->name('deleteBlog');
    Route::get('/viewBlog',[BlogController::class,'viewBlog'])->name('viewBlog');
    Route::post('/upload',[EditorController::class,'uploadMedia'])->name('ckeditor.upload');
    Route::post('/saveMetaData',[BlogController::class,'saveMetaData'])->name('saveMetaData');
    Route::get('/getMetaData',[BlogController::class,'getMetaData'])->name('getMetaData');

    Route::get('/menus',[MenuController::class,'allMenus'])->name('menus');
    Route::post('/new-menu',[MenuController::class,'newMenu'])->name('new-menu');
    Route::get('/get-menu',[MenuController::class,'getMenu'])->name('get-menu');
    Route::get('/delete-menu',[MenuController::class,'deleteMenu'])->name('delete-menu');

    Route::get('/all-technologies',[TechController::class,'allTechnologies'])->name('all-technologies');
    Route::post('/add-technologies',[TechController::class,'addTechnologies'])->name('add-technologies');
    Route::get('/get-technologies',[TechController::class,'getTechnologies'])->name('get-technologies');
    Route::get('/delete-technology',[TechController::class,'deleteTechnology'])->name('delete-technology');

    Route::get('/page-settings',[SettingController::class,'pageSettigs'])->name('page-settings');
    Route::post('/add-setting',[SettingController::class,'addSetting'])->name('add-setting');
    Route::get('/get-setting',[SettingController::class,'getSettings'])->name('get-setting');
    Route::get('/delete-setting',[SettingController::class,'deleteSetting'])->name('delete-setting');

});

Route::get('/',[FrontEndController::class,'viewHome']);
Route::get('/home',[FrontEndController::class,'viewHome']);
Route::get('/about-us',[FrontEndController::class,'viewAboutUs']);
Route::get('/contact-us',[FrontEndController::class,'viewContactUs']);
Route::get("/blog/{id}/{slug}",[FrontEndController::class,'viewBlog']);



