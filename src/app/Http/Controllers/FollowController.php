<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificationReceived;
use App\Models\user;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow()
    {
        $follows = auth()->user()->follows()->paginate(10);

        return view('follow_page', compact('follows'));
    }

    public function follower()
    {
        $followers = auth()->user()->followers()->paginate(10);
        return view('follower_page', compact('followers'));
    }

    public function store($userId)
    {
        $auth_user = Auth::user();
        $followed_user = $auth_user->name;
        $was_followed_user = User::find($userId);
        $auth_user->follows()->attach($userId);

        $notificationData = [
            'follow' => "{$followed_user} がフォローしました",
            // 他のデータを必要に応じて追加
        ];
        $was_followed_user->notify(new NotificationReceived($notificationData));
        return;
    }

    public function destroy($userId)
    {
        Auth::user()->follows()->detach($userId);
        return;
    }
}
