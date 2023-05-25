<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProblemArticleController;
use App\Http\Controllers\ArticleViewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AnnouncementController;
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
    return view('toppage');
});

Auth::routes();

Route::get('/create', function () {
    return view('article_create');
});

Route::post('/store', [ProblemArticleController::class, 'store'])->name('store');


Route::get('/article_view/{id}', [ProblemArticleController::class, 'index'])->name('article_view');

Route::get('/article_edit/{id}', [ArticleViewController::class, 'edit'])->name('article_edit');

Route::post('/update/{id}', [ArticleViewController::class, 'update'])->name('update');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/Profile', [ProfileController::class, 'index'])->name('Profile');

Route::get('/follow_page', [FollowController::class, 'follow'])->name('follow_page');

Route::get('/follower_page', [FollowController::class, 'follower'])->name('follower_page');

Route::post('/destroy/{id}', [ArticleViewController::class, 'destroy'])->name('destroy');

Route::get('/user_edit', [ProfileController::class, 'create'])->name('user_edit');

Route::post('/user_edit', [ProfileController::class, 'edit'])->name('user_update');

Route::post('/like/{id}',[LikeController::class,'store']);

Route::post('/unlike/{id}',[LikeController::class,'destroy']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/follow/{userId}', [ FollowController::class, 'store']);
    Route::post('/follow/{userId}/destroy', [ FollowController::class, 'destroy']);
});

Route::get('/user_page/{id}', [ProfileController::class, 'show'])->name('user_page');

Route::get('/message', [MessageController::class, 'index'])->name('message');

Route::post('/room_create/{user}',[RoomController::class,'store']);


Route::get('/message_form/{userId}', [MessageController::class, 'create'])->name('message_form');

Route::post('/message_data', [MessageController::class, 'store'])->name('message_data');

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

Route::get('/diary/{date}', [CalendarController::class, 'show'])->name('diary');

Route::post('/skin_diary', [CalendarController::class, 'store'])->name('skin_diary');

Route::post('/today_diary_check', [CalendarController::class, 'check'])->name('today_diary_check');

Route::get('/diary_edit/{date}', [CalendarController::class, 'edit'])->name('diary_edit');

Route::post('/skin_diary_update/{date}', [CalendarController::class, 'update'])->name('skin_diary_update');

Route::get('/article_tag_search', [ProblemArticleController::class, 'TagSearch'])->name('article_tag_search');

Route::get('/article_word_search', [ProblemArticleController::class, 'WordSearch'])->name('article_word_search');

Route::get('/diary_data_get', [CalendarController::class, 'data_get'])->name('calendar');

Route::post('/comment/{id}',[ProblemArticleController::class, 'comment'] )->name('comment');

// Route::middleware(['auth'])->get('/announcement_show', [AnnouncementController::class, 'show'])->name('announcement.show');

Route::middleware(['auth'])->get('/notifications', [AnnouncementController::class, 'index'])->name('copy');
