<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProblemArticle;
use App\Models\User;

class Like extends Model
{
    use HasFactory;

    public function likes()
    {
        return $this->hasMany('App\Models\ProblemArticle');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\ProblemArticle');
    }
}
