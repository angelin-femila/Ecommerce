<?php

namespace App\Http\Controllers\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        // Log the incoming request data
        Log::info('Adding to cart', $request->all());

        $request->validate([
            'CartUserID' => 'required|integer',
            'CartProductID' => 'required|integer',
            'CartQuantity' => 'required|integer|min:1',
        ]);

        // Check if the product is already in the cart
        $existingItem = DB::table('carts')
            ->where('CartUserID', $request->CartUserID)
            ->where('CartProductID', $request->CartProductID)
            ->first();

        if ($existingItem) {
            // Update the quantity if already exists
            DB::table('carts')
                ->where('CartID', $existingItem->CartID)
                ->update([
                    'CartQuantity' => $existingItem->CartQuantity + $request->CartQuantity,
                    'CartUpdatedAt' => now(),
                ]);
        } else {
            // Insert new item into the cart
            DB::table('carts')->insert([
                'CartUserID' => $request->CartUserID,
                'CartProductID' => $request->CartProductID,
                'CartQuantity' => $request->CartQuantity,
                'CartCreatedAt' => now(),
                'CartUpdatedAt' => now(),
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully.']);
    }

    public function getCartItems(Request $request)
    {
        $userId = $request->input('CartUserID');
    
        // Fetch cart items along with product details
        $cartItems = DB::table('carts')
            ->join('ministore', 'carts.CartProductID', '=', 'ministore.productid') // Adjust if your field names differ
            ->where('carts.CartUserID', $userId)
            ->select('carts.CartID', 'carts.CartQuantity', 'ministore.productname', 'ministore.productimg', 'ministore.price')
            ->get();
    
        return response()->json($cartItems);
    }
    
    

    // Update a cart item
    public function updateCartItem(Request $request)
    {
        $request->validate([
            'CartID' => 'required|integer',
            'CartQuantity' => 'required|integer|min:1',
        ]);

        // Update the quantity of the specified cart item
        DB::table('carts')
            ->where('CartID', $request->CartID)
            ->update([
                'CartQuantity' => $request->CartQuantity,
                'CartUpdatedAt' => now(),
            ]);

        return response()->json(['message' => 'Cart item updated successfully.']);
    }

    // Delete a cart item
    public function deleteCartItem(Request $request)
    {
        $request->validate([
            'CartID' => 'required|integer',
        ]);

        // Delete the specified cart item
        DB::table('carts')->where('CartID', $request->CartID)->delete();

        return response()->json(['message' => 'Cart item deleted successfully.']);
    }
}
