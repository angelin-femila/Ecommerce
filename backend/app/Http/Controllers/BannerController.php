<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BannerController extends Controller
{
    public function bannerlist()
    {
        // Retrieve all products from the database
        $banners = DB::table('banners')->get();

        // Pass the products to the view
        return view('bannerlist', compact('banners'));
    }

    public function addbanner()
    {
        return view('addbanner');
    }

    public function formsubmit(Request $request)
    {
        // Validate the form input
        $request->validate([

            'BannerImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2050', // Image validation
        ]);

        // Check if file is uploaded
        if ($request->hasFile('BannerImg')) {
            // Get the uploaded file
            $image = $request->file('BannerImg');

            // Generate a unique name for the image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Define the folder where images should be uploaded (inside public directory)
            $imagePath = 'public/images/' . $imageName;

            // Move the image to the public/images folder
            $image->move(public_path('images'), $imageName);
        }

        // Store the full image path in the database
        DB::table('banners')->insert([

            'BannerImg' => $imagePath,  // Store the image path
        ]);

        // Return a success response
        return redirect()->back()->with('success', 'Banner added successfully');
    }

    public function viewBanner($id)
    {
        // Fetch the category by its ID
        $banners = DB::table('banners')->where('BannerID', $id)->first();

        // Pass the category data to the view
        return view('viewbanner', compact('banners'));
    }

    public function editBanner($id)
    {
        // Find the product by its ID
        $banners = DB::table('banners')->where('BannerID', $id)->first();

        // Pass the product data to the edit view
        return view('editbanner', compact('banners'));
    }

    public function updateBanner(Request $request)
    {
        try {
            $request->validate([
               
                'BannerImg' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $banners = DB::table('banners')->where('BannerID', $request->BannerID)->first();

            if (!$banners) {
                return response()->json(['error' => 'Banner not found'], 404);
            }

            $imagePath = $banners->BannerImg;

            if ($request->hasFile('BannerImg')) {
                if ($banners->BannerImg && file_exists(public_path('images/' . $banners->BannerImg))) {
                    unlink(public_path('images/' . $banners->BannerImg));
                }

                $image = $request->file('BannerImg');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'public/images/' . $imageName;
            }

            DB::table('banners')
                ->where('BannerID', $request->BannerID)
                ->update([
                   
                    'BannerImg' => $imagePath,
                ]);

            return response()->json([
                'success' => 'Banner updated successfully',
                'newImagePath' => asset($imagePath),
            ]);
        } catch (\Exception $e) {
            Log::error('Update Banner Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the banner.'], 500);
        }
    }

    public function deleteBanner($id)
    {
        // Delete the product from the database
        DB::table('banners')->where('BannerID', $id)->delete();

        // Redirect back to the product list with a success message
        return redirect('/bannerlist')->with('success', 'Banner deleted successfully');
    }
}
