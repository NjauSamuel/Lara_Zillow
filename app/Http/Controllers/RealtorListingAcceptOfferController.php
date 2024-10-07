<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    //This is a single action controller hence the invoke method. 
    // The invoke method lets you call this class as if it was a function. 

    public function __invoke(Offer $offer)
    {
        // Accept Selected Offer
        $offer->update(['accepted_at' => now()]);

        // After making the sold at offer column, the following is the logic to populate it
        $offer->listing->sold_at = now();
        $offer->listing->save();

        // Reject All Other Offers
        $offer->listing->offers()->except($offer)->update(['rejected_at' => now()]);

        return redirect()->back()->with('success', "Offer #{$offer->id} Accepted, Other Offers Rejected." );
    }
}
