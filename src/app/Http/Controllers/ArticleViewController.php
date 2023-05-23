<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemArticle;
use App\Models\Like;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Follow;
use App\Models\Tag;

class ArticleViewController extends Controller
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

    public function index($id)
    {
        $article = ProblemArticle::find($id);
        $user_id = Auth::user()->id;
        $already_liked = Like::where('user_id', $user_id)->where('problem_article_id', $id)->first();
        $article_user = User::where('id', $article->user_id)->first();
        $article_id = $article->user_id;
        $already_followed = Follow::where('user_id', $user_id)->where('followed_user_id', $article_id)->first();
        $user_check = $article->user_id === $user_id;


        return view('article_view', compact('article','already_liked','article_user','article_id','user_id','already_followed','user_check'));
    }

    public function edit($id)
    {
        $article = ProblemArticle::find($id);

        return view('article_edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = ProblemArticle::find($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = \Auth::id();
        $article->user_name = \Auth::user()->name;
        $image = $request->file('image');
        if($image){
            $dir = 'sample';
            $file = $request->file('image');

            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/' , $file_name);

            $article->name = $file_name;
            $article->path = 'storage/' . $file_name;
        }
        $article->save();

        $tags = $request->input('tag');
        if($tags){
            $article->tags()->detach();
            // dd($tags);
            foreach($tags as $tag){
                if (!empty($tag)){
                    $tag_table = Tag::firstOrCreate(['name' => $tag]);
                    $tag_table->articles()->attach($article->id);
                }
            }
        }

        return redirect (route('home'));
    }

    public function destroy($id)
    {
        $article = ProblemArticle::find($id);

        $article->delete();

        return redirect (route('home'));
    }
}
