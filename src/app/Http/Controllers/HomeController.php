<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemArticle;
use App\Models\User;
use App\Models\Like;
use App\Models\SkinDiary;
use App\Models\DiaryImage;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;

class HomeController extends Controller
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
        $new_articles = ProblemArticle::withCount('likes')->orderBy('updated_at','DESC')
        ->take(10)->get();

        $followings = \Auth::user()->follows()->select('users.id')->get();
        $follow_articles = ProblemArticle::withCount('likes')->whereIn('user_id',$followings->pluck('id'))->orderBy('updated_at','DESC')->paginate(5);

        $authId = \Auth::user()->id;
        $today = Carbon::today()->format('Y-m-d');
        $skin_diary = new SkinDiary;
        $diary_image = new DiaryImage;

        $today_diary = $skin_diary->where('user_id',$authId)->where('date',$today)->first();

        if($today_diary){
            $today_diary_images = $diary_image->where('skin_diary_id',$today_diary->id)->get();
            $images = [];
            foreach ($today_diary_images as $image) {
                $images[] = $image->path;
            }
            return view('home', compact('new_articles','follow_articles','today_diary','today','images'));
        }


        return view('home', compact('new_articles','follow_articles','today_diary','today'));
    }
}
