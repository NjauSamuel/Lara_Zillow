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

        $query = Listing::orderBy('created_at', 'desc')
            ->when(
                $filters['priceFrom'] ?? false,
                fn($query, $value) => $query->where('price', '>=', $value)
            )->when(
                $filters['priceTo'] ?? false,
                fn($query, $value) => $query->where('price', '<=', $value)
            )->when(
                $filters['beds'] ?? false,
                fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
            )->when(
                $filters['baths'] ?? false,
                fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
            )->when(
                $filters['areaFrom'] ?? false,
                fn($query, $value) => $query->where('area', '>=', $value)
            )->when(
                $filters['areaTo'] ?? false,
                fn($query, $value) => $query->where('area', '<=', $value)
            );


        // Above I've chosen to use the when metod instead of an if else statement that is
        // repeated multiple times like the one below, the advantage of using when is that
        // you can chain the methods as shown above instead of separate if statements like below. 
        // if(isset($filters['priceFrom'])){
        //     $query->where('price', '>=', $filters['priceFrom']);
        // }

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => $query->paginate(9)->withQueryString()
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
