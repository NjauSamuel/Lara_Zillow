<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingOfferController extends Controller
{
    // The Store Offer Method
    public function store(Listing $listing, Request $request)
    {

        if (Auth::user()->cannot('view', $listing)){
            abort(403, 'You Can Only Make offers to existing Listings. ');
        }

        $offer = $listing->offers()->save(
            Offer::make(
                $request->validate([
                    'amount' => 'required|integer|min:50000|max:300000000'
                ])
            )->bidder()->associate($request->user())
        );

        $listing->owner->notify(
            new OfferMade($offer)
        );

        return redirect()->back()->with(
            'success', 'Offer was Made!'
        );
    }
}
