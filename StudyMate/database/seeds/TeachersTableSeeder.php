<?php

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::truncate();

        Teacher::create(['name' => 'Klaas']);
        Teacher::create(['name' => 'Henk']);
        Teacher::create(['name' => 'Joost']);
    }
}
