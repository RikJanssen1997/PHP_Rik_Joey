<?php

use App\Models\Lesson;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::Truncate();
        DB::table('lesson_user')->delete();


        $teacherKlaas = Teacher::where('id', 1)->first();
        $teacherHenk = Teacher::where('id', 1)->first();

        $module1 = Module::where('id', 1)->first();
        $module2 = Module::where('id', 2)->first();
        $module3 = Module::where('id', 3)->first();

        $user1 = User::where('id', 1)->first();
        $user2 = User::where('id', 2)->first();
        $user3 = User::where('id', 3)->first();

        $lesson1 = Lesson::create([
            'teacher_id' => $teacherKlaas->id,
            'module_id' => $module1->id
        ]);
        $lesson2 = Lesson::create([
            'teacher_id' => $teacherHenk->id,
            'module_id' => $module2->id
        ]);
        $lesson3 = Lesson::create([
            'module_id' => $module3->id
        ]);
        
        $lesson1->users()->attach($user1, ['grade' => 0, 'ec' => 0]);
        $lesson1->users()->attach($user2, ['grade' => 0, 'ec' => 0]);
        $lesson2->users()->attach($user2, ['grade' => 2, 'ec' => 2]);
        $lesson3->users()->attach($user3, ['grade' => 0, 'ec' => 0]);
        $lesson1->users()->attach($user3, ['grade' => 3, 'ec' => 3]);





    }
}
