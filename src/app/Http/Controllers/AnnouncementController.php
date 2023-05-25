<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementRead;

class AnnouncementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function list(Request $request) {

        $user = \Auth::user();
        $notifications = $user->notifications;
        return response()->json(['data' => $notifications]);
    }
}
