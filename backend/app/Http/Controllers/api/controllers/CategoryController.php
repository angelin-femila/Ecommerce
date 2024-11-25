<?php

namespace App\Http\Controllers\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Add this line for the DB facade
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all categories from the database
        $categories = DB::table('category')->get();

        // Return categories as JSON response
        return response()->json($categories);

        // return response()->json(["Reply"=>"hello"]);
    }

  
    public function getProducts(Request $request)
    {
        $CategoryID = $request->input('CategoryID'); // Use input method to retrieve request data
    
        if (!$CategoryID) {
            return response()->json(['error' => 'CategoryID is required'], 400);
        }
    
        $products = DB::table('ministore')->where('CategoryID', $CategoryID)->get();
    
        return response()->json($products);
    }

    public function getBanners() {
        // Fetch banners from the database
        $banners = DB::table('banners')->get();
    
        // Return banners as JSON
        return response()->json($banners);
    }
    
    
}
