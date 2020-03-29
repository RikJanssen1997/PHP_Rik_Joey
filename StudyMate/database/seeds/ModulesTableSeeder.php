<?php

use App\Models\Block;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\Test;
use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::truncate();
        DB::table('teaching')->delete();

        $teacherKlaas = Teacher::where('id', '1')->first();
        $teacherHenk = Teacher::where('id', '2')->first();
        $teacherJoost = Teacher::where('id', '3')->first();

        $test1 = Test::where('id', 1)->first();
        $test2 = Test::where('id', 2)->first();
        $test3 = Test::where('id', 3)->first();

        $block1 = Block::where('number', 1)->first();
        $block2 = Block::where('number', 2)->first();
        $block3 = Block::where('number', 3)->first();
        $block4 = Block::where('number', 4)->first();

        $prog6 = Module::create([
            'name' => 'Prog6',
            'test_id' => $test1->id,
            'block_id' => $block2->id,
            'ec' => 4
        ]);
        $prog5 = Module::create([
            'name' => 'Prog5',
            'test_id' => $test2->id,
            'block_id' => $block1->id,
            'ec' => 4
        ]);
        $webPHP = Module::create([
            'name' => 'web-php',
            'test_id' => $test3->id,
            'block_id' => $block3->id,
            'ec' => 3
            ]);

        $prog6->toughtBy()->attach($teacherKlaas, ['coordinator' => false]);
        $prog5->toughtBy()->attach($teacherHenk, ['coordinator' => true]);
        $webPHP->toughtBy()->attach($teacherJoost, ['coordinator' => false]);

        
    }
}
