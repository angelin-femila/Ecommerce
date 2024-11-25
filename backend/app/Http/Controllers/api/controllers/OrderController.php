<?php

namespace App\Http\Controllers\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  
    public function placeOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'UserID' => 'required|integer',
            'ProductID' => 'required|integer',
            'TotalAmount' => 'required|numeric',
        ]);
    
        try {
            // Insert the order into the orders table
            DB::table('orders')->insert([
                'UserID' => $request->UserID,
                'ProductID' => $request->ProductID,
                'TotalAmount' => $request->TotalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Respond with success
            return response()->json(['message' => 'Order placed successfully'], 200);
        } catch (\Exception $e) {
            // Respond with error
            return response()->json(['message' => 'Error placing order', 'error' => $e->getMessage()], 500);
        }
    }
    


    
}
