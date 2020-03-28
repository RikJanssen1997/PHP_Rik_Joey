<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    public function edit(Lesson $lesson){
        return view('admin.admin.editGrades')->with([
            'lesson' => $lesson
        ]);
    }
    public function update(Request $request, Lesson $lesson){
        
    }
    
}
