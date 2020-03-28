<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Teacher;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $teachers = Teacher::all();
        $modules = Module::all();
        $lessons = Lesson::all();
        return view('admin.admin.index')->with([
            'lessons' => $lessons,
            'teachers'=> $teachers,
            'modules'=> $modules
            ]);
    }
    public function toCreateModule(){
        
    }
    public function createModule(){

    }
}
