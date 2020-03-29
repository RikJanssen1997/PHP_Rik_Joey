<?php

namespace Tests\Unit;

use App\Models\Module;
use Tests\TestCase;
use App\Http\Controllers\DashboardController;

class ProgressBarTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function calculateProgressExpected40()
    {
        //arrange
        $module1 = factory(Module::class)->make([
            'ec' => 5,
            'gotEC' => 2
        ]);
        $module2 = factory(Module::class)->make([
            'ec' => 5,
            'gotEC' => 2
        ]);
        $modules = [];
        array_push($modules,$module1,$module2);

        //act
        $controller = new DashboardController();
        $result = $controller->calculateProgress($modules);

        //assert
        $this->assertEquals($result, 40);
        

    }
    /** @test */
    public function calculateProgressNotExpected75()
    {
        //arrange
        $module1 = factory(Module::class)->make([
            'ec' => 5,
            'gotEC' => 2
        ]);
        $module2 = factory(Module::class)->make([
            'ec' => 5,
            'gotEC' => 2
        ]);
        $modules = [];
        array_push($modules,$module1,$module2);

        //act
        $controller = new DashboardController();
        $result = $controller->calculateProgress($modules);

        //assert
        $this->assertNotEquals($result, 75);
        

    }
    /** @test */
    public function calculateProgressExpected100()
    {
        //arrange
        $module1 = factory(Module::class)->make([
            'ec' => 10,
            'gotEC' => 10
        ]);
        $module2 = factory(Module::class)->make([
            'ec' => 5,
            'gotEC' => 5
        ]);
        $modules = [];
        array_push($modules,$module1,$module2);

        //act
        $controller = new DashboardController();
        $result = $controller->calculateProgress($modules);

        //assert
        $this->assertEquals($result, 100);
        

    }
    /** @test */
    public function calculateProgressExpected0()
    {
        //arrange
        $module1 = factory(Module::class)->make([
            'ec' => 5,
            'gotEC' => 0
        ]);
        $module2 = factory(Module::class)->make([
            'ec' => 5,
            'gotEC' => 0
        ]);
        $modules = [];
        array_push($modules,$module1,$module2);

        //act
        $controller = new DashboardController();
        $result = $controller->calculateProgress($modules);

        //assert
        $this->assertEquals($result, 0);
        

    }
    /** @test */
    public function calculateProgressNoModulesExpected0()
    {
        //arrange

        $modules = [];

        //act
        $controller = new DashboardController();
        $result = $controller->calculateProgress($modules);

        //assert
        $this->assertEquals($result, 0);
        

    }
}
