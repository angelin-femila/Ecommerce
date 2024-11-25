<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;



//Login
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/dashboard', [TemplateController::class, 'index'])->name('dashboard');

//Products
Route::get('/productlist',[TemplateController::class,'productlist']);
Route::get('/addproductlist',[TemplateController::class,'addproductlist']);
Route::post('/addproductlist', [TemplateController::class, 'formsubmit']); 
Route::get('/viewproduct/{id}', [TemplateController::class, 'viewProduct']);
Route::get('/editproduct/{id}', [TemplateController::class, 'editProduct']);
Route::post('/updateproduct', [TemplateController::class, 'updateProduct']);
Route::get('/deleteproduct/{id}', [TemplateController::class, 'deleteProduct']);

//Category
Route::get('categorylist',[CategoryController::class,'categorylist']);
Route::get('/addcategory',[CategoryController::class,'addcategory']);
Route::post('/addcategory', [CategoryController::class, 'formsubmit']); 
Route::get('/viewcategory/{id}', [CategoryController::class, 'viewCategory']);
Route::get('/editcategory/{id}', [CategoryController::class, 'editCategory']);
Route::post('/updatecategory', [CategoryController::class, 'updateCategory']);
Route::get('/deletecategory/{id}', [CategoryController::class, 'deleteCategory']);


//Banner
Route::get('bannerlist',[BannerController::class,'bannerlist']);
Route::get('/addbanner',[BannerController::class,'addbanner']);
Route::post('/addbanner', [BannerController::class, 'formsubmit']);
Route::get('/viewbanner/{id}', [BannerController::class, 'viewBanner']);
Route::get('/editbanner/{id}', [BannerController::class, 'editBanner']);
Route::post('/updatebanner', [BannerController::class, 'updateBanner']);
Route::get('/deletebanner/{id}', [BannerController::class, 'deleteBanner']);











