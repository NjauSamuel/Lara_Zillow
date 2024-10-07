<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingAcceptOfferController extends Controller
{
    //This is a single action controller hence the invoke method. 
    // The invoke method lets you call this class as if it was a function. 

    public function __invoke(Offer $offer)
    {

        $listing = $offer->listing;

        if (Auth::user()->cannot('update', $listing)){
            abort(403, 'You Can Only Make offers to existing Listings. ');
        }

        // Accept Selected Offer
        $offer->update(['accepted_at' => now()]);

        // After making the sold at offer column, the following is the logic to populate it
        $listing->sold_at = now();
        $listing->save();

        // Reject All Other Offers
        $listing->offers()->except($offer)->update(['rejected_at' => now()]);

        return redirect()->back()->with('success', "Offer #{$offer->id} Accepted, Other Offers Rejected." );
    }
}
