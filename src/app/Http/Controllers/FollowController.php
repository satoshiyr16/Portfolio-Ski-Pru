<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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
        Auth::user()->follows()->attach($userId);
        return;
    }

    public function destroy($userId)
    {
        Auth::user()->follows()->detach($userId);
        return;
    }
}
