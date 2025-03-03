<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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
    ->middleware(['auth', 'verified'])    
    ->group(function() {

        Route::put('listing/{listing}/restore', 
            [RealtorListingController::class, 'restore'])
            ->name('listing.restore')
            ->withTrashed();

        Route::resource('listing', RealtorListingController::class)
            ->withTrashed();

        Route::put('offer/{offer}/accept', RealtorListingAcceptOfferController::class)->name('offer.accept');

        Route::resource('listing.image', RealtorListingImageController::class)
            ->only(['create', 'store', 'destroy']);
    });

// The Notifications Route:
Route::resource('notification', NotificationController::class)
    ->middleware('auth')
    ->only(['index']);

// The Marking Notification As Read
Route::put('notification/{notification}/seen', NotificationSeenController::class)->middleware('auth')
    ->name('notification.seen');

// The Routes for the Email Verification

// 1. The Email Verification Notice Page. 
Route::get('/email/verify', function () {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');


// 2. Page after user clicks the email that was sent over to them. 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('listing')
    ->with('success', 'Email Was Verified. ');
})->middleware(['auth', 'signed'])->name('verification.verify');

// 3. Route for reverifying Email.  (Resending the Verification Email)
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
