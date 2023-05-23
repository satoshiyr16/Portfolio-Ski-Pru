<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProblemArticle;

class Like extends Model
{
    use HasFactory;
    
    public function likes()
    {
        return $this->hasMany('App\Models\ProblemArticle');
    }
}
