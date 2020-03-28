<?php

use App\Models\TestType;
use Illuminate\Database\Seeder;

class TestTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestType::truncate();

        TestType::create(['name' => 'Test']);
        TestType::create(['name' => 'Assessment']);
    }
}
