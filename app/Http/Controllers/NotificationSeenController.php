<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationSeenController extends Controller
{
    //This will be a single action controller

    public function __invoke(Request $request, DatabaseNotification $notification)
    {        
        // Dump the authenticated user and the notifiable_id
        // dd($request->user());

        //dd($notification->notifiable_id);

        if (Auth::user()->cannot('update', $notification)){
            abort(403, "You Can't Update other Peoples Offers.");
        }

        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification Read. ');
    }
}
