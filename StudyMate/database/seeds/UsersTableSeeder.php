<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->delete();

        $adminRole = Role::where('name', 'admin')->first();
        $deadlineManagerRole = Role::where('name', 'deadlineManager')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $author = User::create([
            'name' => 'DeadlineManager User',
            'email' => 'deadlinemanager@deadlinemanager.com',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'name' => 'Generic User',
            'email' => 'user@user.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($deadlineManagerRole);
        $user->roles()->attach($userRole);
    }
}
