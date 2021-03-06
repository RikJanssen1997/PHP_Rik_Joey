<?php

use App\Models\Block;
use App\Models\Period;
use Illuminate\Database\Seeder;

class BlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Block::truncate();

        $period1 = Period::where('number', 1)->first();
        $period2 = Period::where('number', 2)->first();
        $period3 = Period::where('number', 3)->first();
        $period4 = Period::where('number', 4)->first();

        Block::create([
            'number'=> 1,
            'period_id' => $period1->id 
        ]);
        Block::create([
            'number'=> 2,
            'period_id' => $period1->id 
        ]);
        Block::create([
            'number'=> 3,
            'period_id' => $period2->id 
        ]);
        Block::create([
            'number'=> 4,
            'period_id' => $period2->id 
        ]);
        Block::create([
            'number'=> 5,
            'period_id' => $period3->id 
        ]);
        Block::create([
            'number'=> 6,
            'period_id' => $period3->id 
        ]);
        Block::create([
            'number'=> 7,
            'period_id' => $period4->id 
        ]);
        Block::create([
            'number'=> 8,
            'period_id' => $period4->id 
        ]);
    }
}
