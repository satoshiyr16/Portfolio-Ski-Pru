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
use App\Notifications\MessageReceived;



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
        $authId = Auth::user()->id;
        $rooms = Room::with('LatestMessages')
            ->where('receiver_user_id', $authId)
            ->orWhere('sender_user_id', $authId)
            ->get()
            ->sortByDesc(function($room) {
                return $room->LatestMessages->updated_at;
            });

        $follows = auth()->user()->follows()->paginate(10);

        // $rooms = Room::with('LatestMessages')->where('receiver_user_id', $authId)->orWhere('sender_user_id',$authId)->paginate(5);

        return view('message', compact('follows','rooms'));
    }

    public function create($userId)
    {
        $authId = Auth::user()->id;
        session(['data' => $userId]);

        $sender_rooms = Room::where('sender_user_id', $authId)
            ->where('receiver_user_id',$userId)
            ->first();

        $receiver_rooms = Room::where('sender_user_id',$userId)
            ->where('receiver_user_id', $authId)
            ->first();

        $follows = auth()->user()->follows()->get();

        if (empty($sender_rooms) && empty($receiver_rooms)) {
            return view('message_form',compact('follows'));
        }
        if (!empty($sender_rooms) && empty($receiver_rooms)) {
            $messages = Message::with('user')->where('room_id',$sender_rooms->id)->orderBy('updated_at','DESC')->get();

            return view('message_form',compact('follows','messages'));
        }
        if (empty($sender_rooms) && !empty($receiver_rooms)) {
            $messages = Message::with('user')->where('room_id',$receiver_rooms->id)->orderBy('updated_at','DESC')->get();
            return view('message_form',compact('follows','messages'));
        }
        if (!empty($sender_rooms) && !empty($receiver_rooms)) {
            $messages = Message::with('user')->where('room_id',$receiver_rooms->id)->orWhere('room_id',$sender_rooms->id)->orderBy('updated_at','DESC')->get();
            return view('message_form',compact('follows','messages'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|max:50',
            'image' => 'mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $authId = Auth::user()->id;
        $userId = session('data');
        $notification_user = User::find($userId);
        $messages = new Message();

        $first_rooms = Room::where('sender_user_id', $authId)->where('receiver_user_id', $userId)->first();

        $already_rooms = Room::where('sender_user_id', $userId)->where('receiver_user_id', $authId)->first();

        if (!$first_rooms && !$already_rooms) {
            auth()->user()->rooms()->attach($userId);

            $messages->text = $request->input('text');
            $messages->user_id = \Auth::id();
            $image = $request->file('image');
            if ($image) {
                $file = $request->file('image');
                $file_name = $file->getClientOriginalName();
                $file->storeAs('public/', $file_name);
                $messages->path = 'storage/' . $file_name;
            }
            $messages->save();
            $notification_user->notify(new MessageReceived($messages));
        } else {
            // $first_rooms が存在する場合の処理
            if ($first_rooms) {
                $messages->text = $request->input('text');
                $messages->user_id = \Auth::id();
                $messages->room_id = $first_rooms->id;
                $image = $request->file('image');
                if ($image) {
                    $file = $request->file('image');
                    $file_name = $file->getClientOriginalName();
                    $file->storeAs('public/', $file_name);
                    $messages->path = 'storage/' . $file_name;
                }
                $messages->save();
                $notification_user->notify(new MessageReceived($messages));
            }
            // $already_rooms が存在する場合の処理
            elseif ($already_rooms) {
                $messages->text = $request->input('text');
                $messages->user_id = \Auth::id();
                $messages->room_id = $already_rooms->id;
                $image = $request->file('image');
                if ($image) {
                    $file = $request->file('image');
                    $file_name = $file->getClientOriginalName();
                    $file->storeAs('public/', $file_name);
                    $messages->path = 'storage/' . $file_name;
                }
                $messages->save();

                $notification_user->notify(new MessageReceived($messages));
            }
        }



        return redirect()->back();
    }
}
// }
// // 部屋がない
// if(!$first_rooms && !$already_rooms){
//     auth()->user()->rooms()->attach($userId);
//     return;
//     $messages->text = $request->input('text');
//     $messages->user_id = \Auth::id();
//     $messages->room_id = $first_rooms->id;
//     $image = $request->file('image');
//     if($image){
//         $file = $request->file('image');
//         $file_name = $file->getClientOriginalName();
//         $file->storeAs('public/' , $file_name);
//         $messages->path = 'storage/' . $file_name;
//     }
//     $messages->save();
//     $notification_user->notify(new MessageReceived($messages->text));
// } else {
// // どっちもあてはまる
// // receiver_authの場合 reverse_room_checks
//     if($first_rooms){
//         $messages->text = $request->input('text');
//         $messages->user_id = \Auth::id();
//         $messages->room_id = $first_rooms->id;
//         $image = $request->file('image');
//         if($image){
//             $file = $request->file('image');
//             $file_name = $file->getClientOriginalName();
//             $file->storeAs('public/' , $file_name);
//             $messages->path = 'storage/' . $file_name;
//         }
//         $messages->save();
//         $notification_user->notify(new MessageReceived($messages));
//     } else {
//         $messages->text = $request->input('text');
//         $messages->user_id = \Auth::id();
//         $messages->room_id = $already_rooms->id;
//         $image = $request->file('image');
//         if($image){
//             $file = $request->file('image');
//             $file_name = $file->getClientOriginalName();
//             $file->storeAs('public/' , $file_name);
//             $messages->path = 'storage/' . $file_name;
//         }
//         $messages->save();
//         $notification_user->notify(new MessageReceived($messages));
//     }
// }
// if(!$first_rooms && $already_rooms){
//     $messages->text = $request->input('text');
//     $messages->user_id = \Auth::id();
//     $messages->room_id = $already_rooms->id;
//     $image = $request->file('image');
//     if($image){
//         $file = $request->file('image');
//         $file_name = $file->getClientOriginalName();
//         $file->storeAs('public/' , $file_name);
//         $messages->path = 'storage/' . $file_name;
//     }
//     $messages->save();
//     $notification_user->notify(new MessageReceived($messages));
// } else {
//     $messages->text = $request->input('text');
//     $messages->user_id = \Auth::id();
//     $messages->room_id = $first_rooms->id;
//     $image = $request->file('image');
//     if($image){
//         $file = $request->file('image');
//         $file_name = $file->getClientOriginalName();
//         $file->storeAs('public/' , $file_name);
//         $messages->path = 'storage/' . $file_name;
//     }
//     $messages->save();
//     $notification_user->notify(new MessageReceived($messages));
// }
