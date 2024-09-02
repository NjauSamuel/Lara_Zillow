<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Listing/Index', [
            'listings' => Listing::all()
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
        Listing::create($request->all());

        return redirect()->route('listing.index')
            ->with('success', 'Listing was created!');
    }

}
