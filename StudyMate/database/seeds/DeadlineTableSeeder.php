<?php

use App\Models\Deadline;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DeadlineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deadline::truncate();

        $user = User::where('id', 2)->first();

        $tag1 = Tag::where('id', 1)->first();
        $tag2 = Tag::where('id', 2)->first();

        $lesson1 = Lesson::where('id', 1)->first();
        $lesson2 = Lesson::where('id', 2)->first();

        Deadline::create([
            'lesson_id' => $lesson1->id,
            'tag_id' => $tag1->id,
            'finished' => false,
            'user_id' => $user->id,
            'deadline_date' =>  Carbon::parse('2020-05-09')
        ]);
        Deadline::create([
            'lesson_id' => $lesson2->id,
            'tag_id' => $tag2->id,
            'finished' => false,
            'user_id' => $user->id,
            'deadline_date' =>  Carbon::parse('2020-06-09')
        ]);
    }
}
