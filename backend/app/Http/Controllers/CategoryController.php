<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{


    public function categorylist()
    {
        // Retrieve all products from the database
        $categories = DB::table('category')->get();

        // Pass the products to the view
        return view('categorylist', compact('categories'));
    }

    public function addcategory()
    {
        return view('addcategory');
    }

    public function formsubmit(Request $request)
    {
        // Validate the form input
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'CategoryImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2050', // Image validation
        ]);

        // Check if file is uploaded
        if ($request->hasFile('CategoryImg')) {
            // Get the uploaded file
            $image = $request->file('CategoryImg');

            // Generate a unique name for the image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Define the folder where images should be uploaded (inside public directory)
            $imagePath = 'public/images/' . $imageName;

            // Move the image to the public/images folder
            $image->move(public_path('images'), $imageName);
        }

        // Store the full image path in the database
        DB::table('category')->insert([
            'CategoryName' => $request->CategoryName,
            'CategoryImg' => $imagePath,  // Store the image path
        ]);

        // Return a success response
        return redirect()->back()->with('success', 'Category added successfully');
    }


   public function viewCategory($id)
    {
        // Fetch the category by its ID
        $category = DB::table('category')->where('CategoryID', $id)->first();

        // Pass the category data to the view
        return view('viewcategory', compact('category'));
    }


    public function editCategory($id)
    {
        // Find the product by its ID
        $category = DB::table('category')->where('CategoryID', $id)->first();

        // Pass the product data to the edit view
        return view('editcategory', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        try {
            $request->validate([
                'CategoryName' => 'required|string|max:100',
                'CategoryImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $category = DB::table('category')->where('CategoryID', $request->CategoryID)->first();

            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }

            $imagePath = $category->CategoryImg;

            if ($request->hasFile('CategoryImg')) {
                if ($category->CategoryImg && file_exists(public_path('images/' . $category->CategoryImg))) {
                    unlink(public_path('images/' . $category->CategoryImg));
                }

                $image = $request->file('CategoryImg');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'public/images/' . $imageName;
            }

            DB::table('category')
                ->where('CategoryID', $request->CategoryID)
                ->update([
                    'CategoryName' => $request->CategoryName,
                    'CategoryImg' => $imagePath,
                ]);

            return response()->json([
                'success' => 'Category updated successfully',
                'newImagePath' => asset($imagePath),
            ]);
        } catch (\Exception $e) {
            Log::error('Update Category Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the category.'], 500);
        }
    }


    public function deleteCategory($id)
    {
        // Delete the product from the database
        DB::table('category')->where('CategoryID', $id)->delete();

        // Redirect back to the product list with a success message
        return redirect('/categorylist')->with('success', 'Category deleted successfully');
    }
}
