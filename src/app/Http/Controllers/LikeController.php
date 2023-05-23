<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    public function store($id)
    {
        Auth::user()->like($id);
        return 'ok!'; //レスポンス内容
    }

    public function destroy($id)
    {
        Auth::user()->unlike($id);
        return 'ok!'; //レスポンス内容
    }
}
