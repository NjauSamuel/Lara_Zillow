<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Listing/Index', [
            'listings' => Listing::orderBy('created_at', 'desc')
                            ->paginate(10)
                            ->withQueryString()
        ]);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Listing/Create');
    }

    /**
     * Store the newly created resource to database.
     */
    public function store(Request $request)
    {
        //Validating data from Users
        $validated_data = $request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|min:1|max:10000',
            'price' => 'required|integer|min:10000|max:200000000',
        ]);

        // Using the validated data to create the new listing. 
        $request->user()->listings()->create($validated_data);

        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Listing $listing)
    {
        if (Auth::user()->cannot('edit', $listing)){
            abort(403, 'You Can Only Edit Your Posts');
        }

        return inertia('Listing/Edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Listing $listing)
    {
        if (Auth::user()->cannot('update', $listing)){
            abort(403, 'You Can Only Update Your Posts');
        }

        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:10000',
                'price' => 'required|integer|min:10000|max:200000000',
            ])
        );

        return redirect()->route('listing.index')
            ->with('success', 'Listing was Updated!');
    }

    /**
     * Delete the specified resource in storage.
     */

    public function destroy(Listing $listing)
    {
        if (Auth::user()->cannot('delete', $listing)){
            abort(403, 'You Can Only Delete Your Posts');
        }

        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing was Deleted!');
    }

}
