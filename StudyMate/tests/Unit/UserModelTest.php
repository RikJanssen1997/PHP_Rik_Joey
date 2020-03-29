<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;


class UserModelTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function userHasRoleExpectedTrue()
    {
        //arrange
        $role = factory(Role::class)->create([
            'name' => 'testRole'
        ]);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);

        //act
        $result = $user->hasRole('testRole');

        //assert
        $this->assertTrue($result);
    }
    /** @test */
    public function userHasRoleExpectedFalse()
    {
        //arrange
        $role = factory(Role::class)->create([
            'name' => 'testRole'
        ]);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);

        //act
        $result = $user->hasRole('falseRole');

        //assert
        $this->assertFalse($result);

    }
    /** @test */
    public function userHasAnyRolesExpectedTrue()
    {
        //arrange
        $role = factory(Role::class)->create([
            'name' => 'testRole'
        ]);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $array = [];
        array_push($array,'falseRole', 'testRole');

        //act
        $result = $user->hasAnyRoles($array);

        //assert
        $this->assertTrue($result);
    }
    /** @test */
    public function userHasAnyRolesExpectedFalse()
    {
        //arrange
        $role = factory(Role::class)->create([
            'name' => 'testRole'
        ]);
        $user = factory(User::class)->create();
        $user->roles()->attach($role);
        $array = [];
        array_push($array,'falseRole');

        //act
        $result = $user->hasAnyRoles($array);

        //assert
        $this->assertFalse($result);
    
    }
}
