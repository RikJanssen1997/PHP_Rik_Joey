<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    public function edit(Lesson $lesson){
        return view('admin.admin.editGrades')->with([
            'lesson' => $lesson
        ]);
    }
    public function update(Request $request, Lesson $lesson){
        $validatedData = $request->validate([
             'ec'=>'required|array',
             'ec.*' => 'numeric|min:0|max:5',
             'grade'=>'required|array',
             'grade.*' => 'numeric|min:0|max:10'
        ]);
        $counter = 0;
        foreach($lesson->users as $user){
             User::find($user->id)->lessons()->updateExistingPivot($lesson, ['grade' => $request->grade[$counter], 'ec' => $request->ec[$counter]] );
             ++$counter;
        }
        return redirect()->route('admin.admin.index');

    }
    
}
