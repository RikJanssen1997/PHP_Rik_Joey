<?php

use App\Models\Deadline;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(TestTypeTableSeeder::class);
        $this->call(TestTableSeeder::class);
        $this->call(PeriodTableSeeder::class);
        $this->call(BlockTableSeeder::class);
        $this->call(ModulesTableSeeder::class);
        $this->call(LessonTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(DeadlineTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
