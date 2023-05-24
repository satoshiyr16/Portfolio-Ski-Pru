<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemArticle;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

class ProfileController extends Controller
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
    public function index()
    {
        $articles = ProblemArticle::select('problem_articles.*')
            ->where('user_id', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);

        $users = Auth::user();

        $followerCount = count(Follow::where('followed_user_id', $users->id)->get());

        $followCount = count(Follow::where('user_id', $users->id)->get());

        $follows = auth()->user()->follows()->get();
        $followers = auth()->user()->followers()->get();

        return view('Profile', compact('articles', 'users','followCount','followerCount','follows','followers'));
    }

    public function create()
    {
        $users = Auth::user();

        return view('user_edit', compact('users'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'max:12',
            'introduction' => 'max:100',
        ]);
        $users = Auth::user();
        $name_input = $request->input('name');
        if($name_input){
            $users->name = $request->input('name');
        }
        $introduction_input = $request->input('introduction');
        if($introduction_input){
            $users->introduction = $request->input('introduction');
        }

        $image = $request->file('image');
        if($image){
            $file = $request->file('image');

            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/' , $file_name);

            $users->path = 'storage/' . $file_name;
        }
        $users->save();

        return redirect('Profile');
    }

    public function show($id)
    {
        $users = User::find($id);
        $auth = Auth::user()->id;
        $articles = ProblemArticle::select('problem_articles.*')
            ->where('user_id', $users->id)
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);

        $already_followed = Follow::where('user_id', $auth)->where('followed_user_id', $users->id)->first();

        $followerCount = count(Follow::where('followed_user_id', $users->id)->get());

        $followCount = count(Follow::where('user_id', $users->id)->get());

        $follows = auth()->user()->follows()->get();
        $followers = auth()->user()->followers()->get();

        return view('user_page', compact('users','articles','already_followed','followCount','followerCount','follows','followers'));
    }

}
