<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Like;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;

class ProblemArticle extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'title',
        'content',
        'user_id',
        'name',
        'path',
    ];
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
