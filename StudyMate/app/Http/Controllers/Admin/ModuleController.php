<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\TestType;
use App\Models\Block;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testTypes = TestType::all();
        $teachers = Teacher::all();
        $blocks = Block::all();
        return view('admin.admin.createModule')->with([
            'testTypes' => $testTypes,
            'teachers' => $teachers,
            'blocks' => $blocks
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
        $module = new Module;
        $module->name = $request->name;

        $test = new Test;
        $test->test_type_id = $request->testType;
        $test->save();

        $module->test_id = $test->id;
        $module->ec = $request->ec;
        $module->block_id = $request->block;
        $module->save();



        $teacher = Teacher::find($request->coordinator);
        $module->toughtBy()->attach($teacher, ['coordinator' => true]);

        $lesson = new Lesson();
        $lesson->teacher_id = $teacher->id;
        $lesson->module_id = $module->id;
        $lesson->save();

        return redirect()->route('admin.admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $blocks = Block::all();
        $testTypes = TestType::all();
        $teachers = Teacher::all();
        return view('admin.admin.editModule')->with([
            'testTypes' => $testTypes,
            'teachers' => $teachers,
            'module' => $module,
            'blocks' => $blocks
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $test = $module->test()->update([
            'test_type_id' => $request->testType
        ]);
        $module->name = $request->name;
        $module->ec = $request->ec;
        $module->block_id = $request->block;
        $module->save();

        $allTeachers = Teacher::all();
        $removeTeacher = null;
        foreach ($allTeachers as $specificTeacher) {

            if ($specificTeacher->teaching()->wherePivot('module_id', '=', $module->id)->wherePivot('coordinator', '=', '1')->exists()) {
                $removeTeacher = $specificTeacher;
            }
        }

        $teacher = Teacher::find($request->coordinator);

        if ($removeTeacher != NULL) {
            $module->toughtBy()->detach($removeTeacher);
        }
        $module->toughtBy()->detach($teacher);
        $module->toughtBy()->attach($teacher, ['coordinator' => true]);
        $lessons = Lesson::all();
        if ($removeTeacher != NULL && $removeTeacher->id != $teacher->id) {
            if ($lessons->where('module_id', '=', $module->id)->where('teacher_id', '=', $teacher->id)->count() < 1) {
                if ($lessons->where('module_id', '=', $module->id)->where('teacher_id', '=', $removeTeacher->id)->count() > 0) {
                    $lesson = $lessons->where('module_id', '=', $module->id)->where('teacher_id', '=', $removeTeacher->id)->first();
                    $lesson->teacher_id = $teacher->id;
                    $lesson->save();
                    dd('a');
                } else {
                    $lesson = new Lesson();
                    $lesson->teacher_id = $teacher->id;
                    $lesson->module_id = $module->id;
                    $lesson->save();
                    dd('b');
                }
            } else {
                if ($lessons->where('module_id', '=', $module->id)->where('teacher_id', '=', $removeTeacher->id)->count() > 0) {
                    $lesson = $lessons->where('module_id', '=', $module->id)->where('teacher_id', '=', $removeTeacher->id)->first();
                    $newLesson = Lesson::get()->where('module_id', '=', $module->id)->where('teacher_id', '=', $teacher->id)->first();

                    foreach ($lesson->users as $followedLesson) {
                        $grade = $followedLesson->pivot->grade;
                        $ec = $followedLesson->pivot->ec;
                        $newLesson->users()->attach($followedLesson->id, ['grade' => $grade, 'ec' => $ec]);
                    }
                    dd($removeTeacher);
                    $lesson->delete();
                }
            }
        } else {
            if ($lessons->where('module_id', '=', $module->id)->where('teacher_id', '=', $teacher->id)->count() < 1) {
                $lesson = new Lesson();
                $lesson->teacher_id = $teacher->id;
                $lesson->module_id = $module->id;
                $lesson->save();
                dd('e');
            }
        }



        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->test()->delete();
        $module->delete();
        return redirect()->route('admin.admin.index');
    }
}
