<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Controllers\CategoryController; // Import the correct namespace
use App\Http\Controllers\Api\Controllers\AuthController;
use App\Http\Controllers\Api\Controllers\CartController;
use App\Http\Controllers\Api\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/addcategory', [CategoryController::class, 'index']); // Ensure this is separate
Route::post('/getproducts', [CategoryController::class, 'getProducts']);
Route::post('/getbanners', [CategoryController::class, 'getBanners']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Carts
Route::post('/addtocarts', [CartController::class, 'addToCart']);
Route::post('/getcartitems', [CartController::class, 'getCartItems']); 
Route::post('/updatecartitem', [CartController::class, 'updateCartItem']);
Route::post('/deletecartitem', [CartController::class, 'deleteCartItem']); 

Route::post('/placeorder', [OrderController::class, 'placeOrder']);








