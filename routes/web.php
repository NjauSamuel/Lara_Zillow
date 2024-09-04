<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ListingController::class, 'index']);

Route::get('/hello', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class);
