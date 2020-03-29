<?php

namespace App\Http\Controllers\DeadlineManager;

use App\Http\Controllers\Controller;
use App\Models\Deadline;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Tag;
use App\Models\Teacher;
use App\Models\TestType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeadlineManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    function index($deadlines){
        $user = Auth::user();
        return view('deadlineManager.deadlineManager')->with([
            'deadlines' => $deadlines,
            'user' => $user
            ]);
    }

    public function create($lesson)
    {

        $lesson = Lesson::find($lesson);
        $tags = Tag::all();
        return view('deadlineManager.deadlineCreate')->with([
            'tags' => $tags,
            'lesson' => $lesson
        ]);
    }
    public function store(Lesson $lesson, Request $request)
    {
        $validatedData = $request->validate([
            'deadlineDate' => 'required|date',
            
        ]);
        $deadline = new Deadline();
        $newDate = Carbon::parse($request->deadlineDate);
        $deadline->deadline_date = $newDate->format('Y-m-d H:i:s');
        $deadline->tag_id = $request->tag;
        $deadline->lesson_id = $lesson->id;
        $deadline->finished = false;
        $user = Auth::user();
        $deadline->user_id = $user->id;
        $deadline->save();

        return redirect()->route('deadlineManager.deadlinemanager.index');
    }
    
    public function updateFinished(Deadline $deadline, Request $request){
        if($request->finished == "on"){
            $deadline->finished = true;
            $deadline->save();
        }
        else{
            $deadline->finished = false;
            $deadline->save();
        }
        return redirect()->route('deadlineManager.deadlinemanager.index');
    }

    public function destroy(Deadline $deadline){
        $deadline->delete();
        return redirect()->route('deadlineManager.deadlinemanager.index');
    }
    public function noSortDeadlineManager(){
        $user = Auth::user();
        
        $deadlines = Deadline::where('user_id' , $user->id)->get();
        return $this->index($deadlines);
    }
    public function sortModuleDeadlineManager(){
        $user = Auth::user();
        
        $deadlines = Deadline::where('user_id' , $user->id)->get();
        $modules = Module::all();
        $modules = $modules->sortBy('name');
        $newDeadlines = [];
        foreach($modules as $module){
            foreach($deadlines as $deadline){
                if($deadline->lesson()->first()->module()->first()->name == $module->name){
                    array_push($newDeadlines, $deadline);
                }
            }
        }
        return $this->index($newDeadlines);
    }
    public function sortTeacherDeadlineManager(){
        $user = Auth::user();
        
        $deadlines = Deadline::where('user_id' , $user->id)->get();
        $teachers = Teacher::all();
        $teachers = $teachers->sortBy('name');
        $newDeadlines = [];
        foreach($teachers as $teacher){
            foreach($deadlines as $deadline){
                if($deadline->lesson()->first()->teacher()->first()->name == $teacher->name){
                    array_push($newDeadlines, $deadline);
                }
            }
        }
        return $this->index($newDeadlines);
    }
    public function sortDeadlineDateDeadlineManager(){
        $user = Auth::user();
        
        $deadlines = Deadline::where('user_id' , $user->id)->get();
        $newDeadlines = $deadlines->sortBy('deadline_date');
        return $this->index($newDeadlines);
    }
    public function sortCategoryDeadlineManager(){
        $user = Auth::user();
        
        $deadlines = Deadline::where('user_id' , $user->id)->get();

        $testTypes = TestType::all();
        $testTypes = $testTypes->sortBy('name');
        $newDeadlines = [];
        foreach($testTypes as $testType){
            foreach($deadlines as $deadline){
                if($deadline->lesson()->first()->module()->first()->test()->first()->testType()->first()->name == $testType->name){
                    array_push($newDeadlines, $deadline);
                }
            }
        }
        return $this->index($newDeadlines);
    }
}
