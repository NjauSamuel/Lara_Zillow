<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ListingController::class, 'index']);

Route::resource('listing', ListingController::class)
    ->only(['index', 'show']);

// Listing Offer
Route::resource('listing.offer', ListingOfferController::class)
    ->middleware('auth')->only(['store']);

Route::get('login', [AuthController::class, 'create'])->name('login');

Route::post('login', [AuthController::class, 'store'])->name('login.store');

Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);

Route::prefix('realtor')
    ->name('realtor.')
    ->middleware('auth')
    ->group(function() {

        Route::put('listing/{listing}/restore', 
            [RealtorListingController::class, 'restore'])
            ->name('listing.restore')
            ->withTrashed();

        Route::resource('listing', RealtorListingController::class)
            ->only(['index', 'destroy', 'edit', 'update', 'create', 'store'])
            ->withTrashed();

        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });
