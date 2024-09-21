<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, Request $request)
    {

        if ($request->hasFile('images')) {

            // Validating the images received. 

            $request->validate([
                'images.*' => 'mimes:jpg,png,jpeg,webp|max:5000'
            ], [
                'images.*.mimes' => 'The file should be jpg / png / jpeg / webp. '
            ]);

            foreach ($request->file('images') as $file) {

                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'file_name' => $path
                ]));
            }
        }
        return redirect()->back()->with('success', 'Images uploaded!');
    }

    // For removing the listing
    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->file_name);

        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted. ');
    }
}
