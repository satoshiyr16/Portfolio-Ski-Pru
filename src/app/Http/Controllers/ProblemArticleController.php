<?php

namespace App\Http\Controllers;

use App\Models\ProblemArticle;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Follow;
use App\Notifications\NotificationReceived;


class ProblemArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        session(['article_id' => $id]);
        $article = ProblemArticle::find($id);
        $user_id = \Auth::id();
        $already_liked = Like::where('user_id', $user_id)->where('problem_article_id', $id)->first();
        $article_user = User::where('id', $article->user_id)->first();
        $article_id = $article->user_id;
        $already_followed = Follow::where('user_id', $user_id)->where('followed_user_id', $article_id)->first();
        $user_check = $article->user_id === $user_id;
        $comments = Comment::where('problem_article_id',$id)->orderBy('updated_at','DESC')->get();

        return view('article_view', compact('article','already_liked','article_user','article_id','user_id','already_followed','user_check','comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'image' => 'mimes:jpeg,png,pdf|max:2048',
            'tag.*' => 'max:15',
            'content' => 'required',
        ]);
        $problemArticle = new ProblemArticle();
        $problemArticle->title = $request->input('title');
        $problemArticle->content = $request->input('content');
        $problemArticle->user_id = \Auth::id();
        $problemArticle->user_name = \Auth::user()->name;
        $image = $request->file('image');
        if($image){
            $file = $request->file('image');

            $file_name = $file->getClientOriginalName();
            $file->storeAs('public/' , $file_name);

            $problemArticle->name = $file_name;
            $problemArticle->path = 'storage/' . $file_name;
        }
        $problemArticle->save();

        $tags = $request->input('tag');
        if($tags){
            foreach($tags as $tag){
                if (!empty($tag)){
                    $tag_table = Tag::firstOrCreate(['name' => $tag]);
                    $tag_table->articles()->attach($problemArticle->id);
                }
            }
        }

        return redirect (route('home'));
    }

    public function edit($id)
    {
        $article = ProblemArticle::find($id);

        return view('article_edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:50',
            'image' => 'mimes:jpg,jpeg,png,pdf|max:2048',
            'tag.*' => 'max:15',
            'content' => 'required',
        ]);
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

        return 'success';
        // return redirect (route('home'));
    }

    public function TagSearch(Request $request)
    {
        $request->validate([
            'tag_word' => 'max:15',
        ]);
        $tag_word = $request->input('tag_word');
        $articles = [];
        if($tag_word){
            $tag = Tag::where('name',$tag_word)->first();
            if($tag){
                $tag_article_results = $tag->articles()->withCount('likes')
                ->paginate(6);
                return view('article_tag_search', compact('tag_article_results'));
            } else {
                $tag_article_results = null;
            }
        } else {
            $tag_article_results = null;
        }

        return view('article_tag_search', compact('tag_article_results'));
    }

    public function WordSearch(Request $request)
    {
        $request->validate([
            'word' => 'max:50',
        ]);
        $word = $request->input('word');
        if($word){
            $word_article_results = ProblemArticle::where('title', 'like', '%' . $word . '%')
            ->withCount('likes')
            ->paginate(6);
            if(empty($word_article_results)){
                $word_article_results = null;
            }
            return view('article_word_search', compact('word_article_results'));
        } else {
            $word_article_results = null;
        }

        return view('article_word_search', compact('word_article_results'));

    }

    public function Comment(Request $request)
    {
        $request->validate([
            'comment' => 'max:130',
        ]);
        $auth_user = \Auth::user();
        $user_id = \Auth::user()->id;
        $comment_send_user = $auth_user->name;
        $article_id = $request->input('article_id');
        $commentTable = new Comment();
        $commentTable->user_id = $user_id;
        $commentTable->problem_article_id = $article_id;
        $commentTable->comment = $request->input('comment');
        $commentTable->save();
        $notificationData = [
            'comment' => "{$comment_send_user} からコメント: {$commentTable->comment}",
        ];
        $article = ProblemArticle::find($article_id);
        $article_user = $article->user;
        $article_user->notify(new NotificationReceived($notificationData));
        return redirect()->back();
    }
}
