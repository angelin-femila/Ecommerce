<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Add this line

class TemplateController extends Controller
{
    //
    public function index()
    {
        return view('dashboard');
    }
    public function productlist()
    {
        // Join the ministore table with the category table to fetch category names
        $products = DB::table('ministore')
                    ->leftJoin('category', 'ministore.CategoryID', '=', 'category.CategoryID')
                    ->select('ministore.*', 'category.CategoryName') // Select all product fields and the category name
                    ->get();
    
        // Pass the products to the view
        return view('productlist', compact('products'));
    }
    

    public function addproductlist()
    {
        $categories = DB::table('category')->get();
        return view('addproductlist', compact('categories'));
    }


    public function formsubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'stock' => 'required|integer',
            'category' => 'required|integer',
            'productimg' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:2050', // Image validation
        ]);

        // Check if file is uploaded
        if ($request->hasFile('productimg')) {
            // Get the uploaded file
            $image = $request->file('productimg');

            // Generate a unique name for the image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Define the folder where images should be uploaded (inside public directory)
            $imagePath = 'public/images/' . $imageName;

            // Move the image to the public/images folder
            $image->move(public_path('images'), $imageName);
        }

        DB::table('ministore')->insert([
            'productname' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'CategoryID' => $request->category,
            'productimg' => $imagePath,
        ]);

        // Return a success response
        return redirect()->back()->with('success', 'Product added successfully');
    }

     public function viewProduct($id)
    {
        // Fetch the product by its ID
        $product = DB::table('ministore')->where('productid', $id)->first();
    
        // Pass the product data to the view
        return view('viewproduct', compact('product'));
    }
    

    public function editProduct($id)
    {
        // Find the product by its ID
        $product = DB::table('ministore')->where('productid', $id)->first();

        // Pass the product data to the edit view
        return view('editproduct', compact('product'));
    }


    public function updateProduct(Request $request)
    {
        $request->validate([
            'productname' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'stock' => 'required|integer',
            'productimg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $id = $request->input('productid');

        Log::info('Updating product with ID: ' . $id);

        $product = DB::table('ministore')->where('productid', $id)->first();

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $imagePath = $product->productimg;

        if ($request->hasFile('productimg')) {
            if ($product->productimg && file_exists(public_path($product->productimg))) {
                unlink(public_path($product->productimg));
            }

            $image = $request->file('productimg');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'public/images/' . $imageName;
        }

        DB::table('ministore')->where('productid', $id)->update([
            'productname' => $request->input('productname'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'productimg' => $imagePath,
        ]);

        return response()->json(['success' => 'Product updated successfully']);
    }




    public function deleteProduct($id)
    {
        // Delete the product from the database
        DB::table('ministore')->where('productid', $id)->delete();

        // Redirect back to the product list with a success message
        return redirect('/productlist')->with('success', 'Product deleted successfully');
    }
}
