<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SkinDiary;
use App\Models\DiaryImage;


class CalendarController extends Controller
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
        return view('calendar');
    }

    public function show($date)
    {
        $authId = \Auth::user()->id;
        session(['data' => $date]);

        return view('diary', ['date' => $date], compact('date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skin_status_text' => 'max:500',
            'acne_status_text' => 'max:500',
            'food_content_text' => 'max:500',
            'skincare_content_text' => 'max:500',
            'images.*' => 'mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $authId = \Auth::user()->id;
        $diary_date = session('data');

        $skin_diary = new SkinDiary;
        $skin_diary->user_id = $authId;
        $skin_diary->date = $diary_date;
        $skin_diary->skin_tone = $request->input('skin_tone');
        $skin_diary->skin_status = $request->input('skin_status');
        $skin_diary->skin_status_text = $request->input('skin_status_text');
        $skin_diary->acne = $request->input('acne');
        $skin_diary->acne_status_text = $request->input('acne_status_text');
        $skin_diary->food = $request->input('food');
        $skin_diary->food_content_text = $request->input('food_content_text');
        $skin_diary->skincare = $request->input('skincare');
        $skin_diary->skincare_content_text = $request->input('skincare_content_text');
        $skin_diary->sleep = $request->input('sleep');
        $skin_diary->defecation = $request->input('defecation');
        $skin_diary->face_wash = $request->input('face_wash');
        $skin_diary->menstruation = $request->input('menstruation');
        $skin_diary->save();


        $images = $request->file('images');
        if($images){
            foreach($images as $image){
                $diary_images = new DiaryImage;
                $diary_images->skin_diary_id = $skin_diary->id;
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/' , $file_name);
                $diary_images->path = 'storage/' . $file_name;
                $diary_images->save();
            }
        }

        return redirect('/home');
    }

    public function check(Request $request)
    {
        $date = $request->input('date');
        $exists = SkinDiary::where('date', $date)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function edit($date)
    {
        $skin_diary = SkinDiary::where('date',$date)->first();
        $diary_image = new DiaryImage;

        $today_diary_images = $diary_image->where('skin_diary_id',$skin_diary->id)->get();
        $images = [];
        foreach ($today_diary_images as $image) {
            $images[] = $image;
        }

        return view('diary_edit',compact('date','skin_diary','images'));
    }

    public function update(Request $request ,$date)
    {
        $request->validate([
            'skin_status_text' => 'max:500',
            'acne_status_text' => 'max:500',
            'food_content_text' => 'max:500',
            'skincare_content_text' => 'max:500',
            'images.*' => 'mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $authId = \Auth::user()->id;
        $skin_diary = SkinDiary::where('date',$date)->first();

        $skin_diary->user_id = $authId;
        $skin_diary->date = $date;
        $skin_diary->skin_tone = $request->input('skin_tone');
        $skin_diary->skin_status = $request->input('skin_status');
        $skin_diary->skin_status_text = $request->input('skin_status_text');
        $skin_diary->acne = $request->input('acne');
        $skin_diary->acne_status_text = $request->input('acne_status_text');
        $skin_diary->food = $request->input('food');
        $skin_diary->food_content_text = $request->input('food_content_text');
        $skin_diary->skincare = $request->input('skincare');
        $skin_diary->skincare_content_text = $request->input('skincare_content_text');
        $skin_diary->sleep = $request->input('sleep');
        $skin_diary->defecation = $request->input('defecation');
        $skin_diary->face_wash = $request->input('face_wash');
        $skin_diary->menstruation = $request->input('menstruation');

        $images = $request->file('images');
        // dd($images);
        if($images){
            foreach($images as $image){
                $diary_image = new DiaryImage;
                $diary_image->skin_diary_id = $skin_diary->id;
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/' , $file_name);
                $diary_image->path = 'storage/' . $file_name;
                $diary_image->save();
            }
        }
        $deletedImages = json_decode($request->input('deleted_images'), true);
        // dd($deletedImages);
        if ($deletedImages) {
            foreach($deletedImages as $deletedImage){
                $diary_image = new DiaryImage;
                // 対応する画像を削除する
                $diary_image->where('id', $deletedImage)->delete();
            }
        }
        $skin_diary->save();

        return redirect('/home');
    }
    
    public function data_get(){
        $skin_diaries = SkinDiary::select('id', 'date', 'skin_tone')
        ->get()
        ->map(function ($skin_diary) {
            return [
                'id' => $skin_diary->id,
                'title' => $skin_diary->skin_tone,
                'start' => $skin_diary->date,
                'extendedProps' => [
                    'skin_tone' => $skin_diary->skin_tone
                ]
            ];
        });

        return response()->json($skin_diaries);
    }

}
