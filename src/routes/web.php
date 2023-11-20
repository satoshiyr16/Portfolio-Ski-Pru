<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProblemArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\SkinDiary;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('top_page');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('notifications_delete', [HomeController::class, 'NotificationsDelete'])->name('notifications_delete');

    // ↓投稿記事
    Route::get('/article_view/{id}', [ProblemArticleController::class, 'index'])->name('article_view');

    Route::get('/create', function () {
        return view('article_create');
    });

    Route::post('/store', [ProblemArticleController::class, 'store'])->name('store');

    Route::get('/article_edit/{id}', [ProblemArticleController::class, 'edit'])->name('article_edit');

    Route::post('/update/{id}', [ProblemArticleController::class, 'update'])->name('update');

    Route::post('/destroy/{id}', [ProblemArticleController::class, 'destroy'])->name('destroy');

    Route::get('/article_tag_search', [ProblemArticleController::class, 'TagSearch'])->name('article_tag_search');

    Route::get('/article_word_search', [ProblemArticleController::class, 'WordSearch'])->name('article_word_search');

    Route::post('/comment/{id}',[ProblemArticleController::class, 'comment'] )->name('comment');


    // ↓いいね機能
    Route::post('/like/{id}',[LikeController::class,'store']);

    Route::post('/unlike/{id}',[LikeController::class,'destroy']);

    // フォロー機能
    Route::post('/follow/{userId}', [ FollowController::class, 'store']);

    Route::post('/follow/{userId}/destroy', [ FollowController::class, 'destroy']);

    Route::get('/follow_page', [FollowController::class, 'follow'])->name('follow_page');

    Route::get('/follower_page', [FollowController::class, 'follower'])->name('follower_page');


    //↓ユーザー関係
    Route::get('/Profile', [ProfileController::class, 'index'])->name('Profile');

    Route::get('/user_edit', [ProfileController::class, 'create'])->name('user_edit');

    Route::post('/user_edit', [ProfileController::class, 'edit'])->name('user_update');

    Route::get('/user_page/{id}', [ProfileController::class, 'show'])->name('user_page');


    // ↓メッセージ機能
    Route::get('/message', [MessageController::class, 'index'])->name('message');

    Route::post('/room_create/{user}',[RoomController::class,'store']);

    Route::get('/message_form/{userId}', [MessageController::class, 'create'])->name('message_form');

    Route::post('/message_data', [MessageController::class, 'store'])->name('message_data');


    // 日記機能
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

    Route::get('/diary/{date}', [CalendarController::class, 'show'])->name('diary');

    Route::post('/skin_diary', [CalendarController::class, 'store'])->name('skin_diary');

    Route::post('/today_diary_check', [CalendarController::class, 'check'])->name('today_diary_check');

    Route::get('/diary_edit/{date}', [CalendarController::class, 'edit'])->name('diary_edit');

    Route::post('/skin_diary_update/{date}', [CalendarController::class, 'update'])->name('skin_diary_update');

    Route::get('/diary_data_get', [CalendarController::class, 'data_get'])->name('calendar');


    // ↓通知機能
    Route::get('/notifications', [AnnouncementController::class, 'index'])->name('copy');
});

Route::get('/guest-login', [LoginController::class, 'guestLogin'])->name('guest.login');
