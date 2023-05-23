<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ProblemArticle;
use App\Models\Room;
use App\Models\Room_User;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes(){
        return $this->belongsToMany('App\Models\ProblemArticle','likes','user_id','problem_article_id')->withTimestamps();
    }

    public function isLike($id)
    {
        return $this->likes()->where('problem_article_id',$id)->exists();
    }

    public function like($id)
    {
        if($this->isLike($id)){
        //もし既に「いいね」していたら何もしない
        } else {
        $this->likes()->attach($id);
        }
    }

    public function unlike($id)
    {
        if($this->isLike($id)){
        //もし既に「いいね」していたら消す
        $this->likes()->detach($id);
        } else {
        }
    }

    public function posts()
    {
        return $this->hasMany('App\Models\ProblemArticle');
    }

    public function follows()
    {
        return $this->belongsToMany('App\Models\User','follows','user_id','followed_user_id')->withTimestamps();
        //followed_user_id = ログインしたuserがフォローしたuserのこと
    }

    public function followers()
    {
        return $this->belongsToMany('App\Models\User','follows','followed_user_id','user_id')->withTimestamps();
    }

    public function rooms()
    {
        return $this->belongsToMany('App\Models\User','rooms','sender_user_id','receiver_user_id')->withTimestamps();
    }


    public function messages()
    {
        return $this->belongsTo(Message::class);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
