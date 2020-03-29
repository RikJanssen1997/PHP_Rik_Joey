<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        Tag::create(['name' => 'leuk']);
        Tag::create(['name' => 'niet leuk']);
        Tag::create(['name' => 'makkelijk']);
        Tag::create(['name' => 'moeilijk']);
        Tag::create(['name' => 'veel werk']);
        Tag::create(['name' => 'weinig werk']);
    }
}
