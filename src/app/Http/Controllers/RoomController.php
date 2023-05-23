<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemArticle;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\Room;
use App\Models\Room_User;

class RoomController extends Controller
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
    public function store($user)
    {
        // sender_user_id,$user、receiver_user_id,$auth
        $authId = Auth::user()->id;
        $already_room = Room::where('sender_user_id', $authId)->where('receiver_user_id', $user)->first();

        $room_check = Room::where('sender_user_id', $user)->where('receiver_user_id', $authId)->exists();

        if($already_room && $room_check){
            auth()->user()->rooms()->attach($user);
                return;
        }
    }
}
