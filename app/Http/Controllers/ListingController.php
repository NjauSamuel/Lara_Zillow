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
    public function index(Request $request)
    {

        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter($filters)
                ->withoutSold()
                ->paginate(9)
                ->withQueryString()
        ]);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {

        $listing->load(['images']);
        
        // Disable unauthorized users from making offers. 
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();   // The scoped method mentioned is in the offer model. 

        return inertia('Listing/Show', [
            'listing' => $listing, 
            'offerMade' => $offer
        ]);
    }

}
