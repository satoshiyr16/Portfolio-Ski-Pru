<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Announcement;
use App\Models\AnnouncementRead;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::orderBy('id')->pluck('id');

        for($i = 0 ; $i < 10 ; $i++) {

            $announcement = new Announcement();
            $announcement->title = 'テストタイトル - '. $i;
            $announcement->description = "テストお知らせ - ". $i;
            $announcement->save();

            foreach ($user_ids as $user_id) {

                $read = new AnnouncementRead();
                $read->user_id = $user_id;
                $read->announcement_id = $announcement->id;
                $read->save();

            }

        }
    }
}
