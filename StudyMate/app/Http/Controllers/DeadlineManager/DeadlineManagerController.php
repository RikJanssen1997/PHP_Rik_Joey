<?php

namespace App\Http\Controllers\DeadlineManager;

use App\Http\Controllers\Controller;
use App\Models\Deadline;
use App\Models\Lesson;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeadlineManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function sortArray(){
        usort($array, 'comparatorModule');
        //https://www.geeksforgeeks.org/sort-array-of-objects-by-object-fields-in-php/
    }

    function comparatorModule($object1, $object2){
        return $object1->Module > $object2->Module;
    }

    function index(){
        $user = Auth::user();
        $deadlines = Deadline::where('user_id' , $user->id)->get();
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
}
