<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProblemArticle;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    public function articles()
    {
        return $this->belongsToMany(ProblemArticle::class, 'article_tags');
    }
}
