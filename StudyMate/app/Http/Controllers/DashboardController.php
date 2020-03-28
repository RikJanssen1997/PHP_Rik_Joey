<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class DashboardController extends Controller
{
    public function index(){

        $modules = [];
        
        $module = $this->addModule_temporarily('Webdevelopment 1','WEBS1','2','2','6');
        array_push($modules, $module);

        $module = $this->addModule_temporarily('PHP 1','PHP1','4','0','4');
        array_push($modules, $module);

        $module = $this->addModule_temporarily('Javascript','WEBJS','7','2','2');
        array_push($modules, $module);

        return view('welcome')->with('modules', $modules);
    }

    public function addModule_temporarily($naam,$Afkorting,$Studiepunt,$BehalenStudiepunt,$Cijfer){
        $module = new stdClass();
        $module->StudyPoints = $Studiepunt;
        $module->maxStudyPoints = $BehalenStudiepunt;
        $module->title = $naam;
        $module->grade = $Cijfer;
        $module->short = $Afkorting;

        return $module;
    }
}
