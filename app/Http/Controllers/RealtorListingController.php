<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class RealtorListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd((bool)$request->boolean('deleted'));

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];
        
        return inertia(            
            'Realtor/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                ->listings()
                // ->mostRecent()
                ->filter($filters)
                ->withCount('images')
                ->withCount('offers') // To count the appearances of a relationship offers. 
                ->paginate(8)->
                withQueryString()
            ]
        );
    }

    // A count route for showing offers
    public function show(Listing $listing)
    {

        // Authorizaiton to view Listings. 
        Gate::allowIf(fn (User $user) => $user->id === $listing->by_user_id);

        return inertia(
            'Realtor/Show', 
            ['listing' => $listing->load('offers', 'offers.bidder')]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
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

        return redirect()->route('realtor.listing.index')
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
 
         return inertia('Realtor/Edit', [
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
 
         return redirect()->route('realtor.listing.index')
             ->with('success', 'Listing was Updated!');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {

        if (Auth::user()->cannot('delete', $listing)){
            abort(403, 'You Can Only Delete Your Posts');
        }

        $listing->deleteOrFail();

        return redirect()->back()
            ->with('success', 'Listing was Deleted!');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was Restored!');
    }
    
}
