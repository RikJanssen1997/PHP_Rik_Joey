<?php

use App\Models\Test;
use App\Models\TestType;
use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Test::truncate();

        $assessment = TestType::where('name', 'Assessment')->first();
        $test = TestType::where('name', 'Test')->first();

        Test::create(
            ['test_type_id'=> $test->id]
        );
        Test::create(
            ['test_type_id'=> $assessment->id]
        );
        Test::create(
            ['test_type_id'=> $assessment->id]
        );


    }
}
