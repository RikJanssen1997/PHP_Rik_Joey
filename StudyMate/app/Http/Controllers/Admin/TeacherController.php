<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::all();
        return view('admin.admin.createTeacher')->with([
          'modules'=>$modules
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->save();
        foreach($request->modules as $module){
            $newModule = Module::find($module);
            $teacher->teaching()->attach($newModule, ['coordinator' => false]);
            $lesson = new Lesson();
            $lesson->teacher_id = $teacher->id;
            $lesson->module_id = $newModule->id;
            dd($lesson);
            $lesson->save();
        }
        return redirect()->route('admin.admin.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        $modules = Module::all();
        return view('admin.admin.editTeacher')->with([
            'modules'=>$modules,
            'teacher'=>$teacher
          ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $coordinators = array();
        foreach($teacher->teaching()->get() as $taught){
            if($teacher->teaching()->wherePivot('module_id', '=', $taught->id)->wherePivot('coordinator', '=', '1')->exists()){
                array_push($coordinators, $taught);
            }
             
        }
        $teacher->teaching()->detach();
        if(is_array($request->modules) || is_object($request->modules)){
            foreach($request->modules as $module){
                $newModule = Module::find($module);
                $contains = false;
    
                foreach($coordinators as $possibleCoordinator){
                    if($possibleCoordinator->id == $newModule->id){
                        $contains = true;
                    }
                }
                if($contains){
                    $teacher->teaching()->attach($newModule, ['coordinator' => true]);
                }
                else{
                    $teacher->teaching()->attach($newModule, ['coordinator' => false]);
                }
            }
        }
        
        $teacher->name = $request->name;
        $teacher->save();
        $lessons = Lesson::get()->where('teacher_id', '=', $teacher->id);
        foreach($lessons as $lesson){
            if($teacher->teaching()->wherePivot('module_id', '=', $lesson->module_id)->count()<1){
                $lesson->teacher_id = NULL;
                $lesson->save();
            }
        }
        $modules = Module::all();
        foreach($modules as $newModule){
            if($newModule->toughtBy()->wherePivot('teacher_id', '=', $teacher->id)->count()>0){
                if($teacher->lessons()->where('module_id', '=', $newModule->id)->count()<1){
                    $newLesson = new Lesson();
                    $newLesson->teacher_id = $teacher->id;
                    $newLesson->module_id = $newModule->id;
                    $newLesson->save();
                }
            }
        }
        

        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $lessons = Lesson::get()->where('teacher_id', '=', $teacher->id);
        foreach($lessons as $lesson){
            $lesson->teacher_id = NULL;
            $lesson->save();

        }   
        $teacher->delete();
        return redirect()->route('admin.admin.index');
    }
}
