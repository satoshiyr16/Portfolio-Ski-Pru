<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProblemArticle;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\Room;
use App\Models\Room_User;
use App\Models\Message;
use App\Notifications\NotificationReceived;
use Psy\Readline\Userland;

class MessageController extends Controller
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

    public function index()
    {
        $AuthId = Auth::user()->id;
        $rooms = Room::with('LatestMessages')
            ->where('receiver_user_id', $AuthId)
            ->orWhere('sender_user_id', $AuthId)
            ->get()
            ->sortByDesc(function($room) {
                return $room->LatestMessages->updated_at;
            });

        return view('message', compact('rooms'));
    }

    public function create($userId)
    {
        $AuthId = Auth::user()->id;
        $AuthUser_sender_rooms = Room::where('sender_user_id', $AuthId)
            ->where('receiver_user_id',$userId)
            ->first();
        $AuthUser_receiver_rooms = Room::where('sender_user_id',$userId)
            ->where('receiver_user_id', $AuthId)
            ->first();

        // メッセージが何もない
        if (empty($AuthUser_sender_rooms) && empty($AuthUser_receiver_rooms)) {
            return view('message_form',compact('userId'));
        }
        // 最初にメッセージを送ったのが自分の場合
        if (!empty($AuthUser_sender_rooms) && empty($AuthUser_receiver_rooms)) {
            $messages = Message::with('user')->where('room_id',$AuthUser_sender_rooms->id)->orderBy('updated_at','DESC')->get();
            return view('message_form',compact('messages','userId'));
        }
        // 最初にメッセージを送ったのが相手の場合
        if (empty($AuthUser_sender_rooms) && !empty($AuthUser_receiver_rooms)) {
            $messages = Message::with('user')->where('room_id',$AuthUser_receiver_rooms->id)->orderBy('updated_at','DESC')->get();
            return view('message_form',compact('messages','userId'));
        }

        //メッセージを送ったり受け取ったことがある場合
        // if (!empty($AuthUser_sender_rooms) && !empty($AuthUser_receiver_rooms)) {
        //     $messages = Message::with('user')->where('room_id',$AuthUser_receiver_rooms->id)->orWhere('room_id',$AuthUser_sender_rooms->id)->orderBy('updated_at','DESC')->get();
        //     return view('message_form',compact('messages','userId'));
        // }
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|max:50',
            'image' => 'mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $Auth_user = Auth::user();
        $userId = $request->input('userId');
        $notification_user = User::find($userId);
        $AuthUser_send_rooms = Room::where('sender_user_id', $Auth_user->id)->where('receiver_user_id', $userId)->first();

        $AuthUser_receive_rooms = Room::where('sender_user_id', $userId)->where('receiver_user_id', $Auth_user->id)->first();

        $messages = new Message();
        //初めてメッセージを送る
        if (!$AuthUser_send_rooms && !$AuthUser_receive_rooms) {
            auth()->user()->rooms()->attach($userId);
            $new_room = Room::where('sender_user_id', $Auth_user->id)->where('receiver_user_id',$userId)->first();
            $messages->room_id = $new_room->id;
        } else {
            // すでにメッセージを送っている & 初めてメッセージを送ったのが自分
            if ($AuthUser_send_rooms) {
                $messages->room_id = $AuthUser_send_rooms->id;
            }
            // すでにメッセージを送っている & 初めてメッセージを送ったのが相手
            elseif ($AuthUser_receive_rooms) {
                $messages->room_id = $AuthUser_receive_rooms->id;
            }
        }
        $messages->text = $request->input('text');
        $messages->user_id = $Auth_user->id;
        $image = $request->file('image');
            if ($image) {
                $file = $request->file('image');
                $file_name = $file->getClientOriginalName();
                $file->storeAs('public/', $file_name);
                $messages->path = 'storage/' . $file_name;
            }
        $messages->save();
        $notificationData = [
            'message' => "{$Auth_user->name} からメッセージ: {$messages->text}",
            // 他のデータを必要に応じて追加
        ];
        $notification_user->notify(new NotificationReceived($notificationData));

        return redirect()->back();
    }
}
