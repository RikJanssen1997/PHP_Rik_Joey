<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;

class LessonController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        $users = User::all();

        return view('admin.admin.editLessonStudents')->with([
            'users' => $users,
            'lesson' => $lesson
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        
        if(is_array($request->users) || is_object($request->users)){
            foreach($lesson->users()->get() as $user){
                $delete = true;
                foreach($request->users as $userRequest){
                    if($user->id == $userRequest){
                        $delete = false;
                    }
                }
                if($delete){
                    $lesson->users()->detach($user);
                }
            }
            $addUsers = array();
            foreach($request->users as $userRequest){
                $add = true;
                foreach($lesson->users()->get() as $user){
                    if($userRequest == $user->id){
                        $add = false;
                    }
                    
                }
                if($add){
                    array_push($addUsers, $userRequest);
                }
                

            }
            foreach($addUsers as $newUser){
                $lesson->users()->attach($newUser, ['grade' => 0, 'ec' => 0]);
            }
        }
        else{
            $lesson->users()->detach();
            
        }
        return redirect()->route('admin.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
