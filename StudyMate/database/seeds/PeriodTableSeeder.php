<?php

use Illuminate\Database\Seeder;
use App\Models\Period;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::Truncate();

        Period::create(['number' => 1]);
        Period::create(['number' => 2]);
        Period::create(['number' => 3]);
        Period::create(['number' => 4]);
    }
}
