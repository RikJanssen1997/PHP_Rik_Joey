<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Period;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;

class DashboardController extends Controller
{
    public function index()
    {
        $periods = Period::all();
        $blocks = Block::all();

        foreach ($periods as $key => $period) {
            $periodBlocks = Block::where('period_id', $period->id)->get();
            $period["blocks"] = $periodBlocks;
        }

        $users = User::all();


        $progress = 0;
        return view('welcome')->with([
            'periods' => $periods,
            'users' => $users,
            'progress' => $progress,
            'totalEC' => 0,
            'totalObtainedEC' => 0,
        ]);
    }
    public function openUser($id)
    {
        if(User::where('id',$id)->first() == null){
            return $this->index();
        }else{
            $periods = Period::all();
            $blocks = Block::all();
                
            $users = User::select('id', 'name')->get();
            $user = User::select('id', 'name')->where('id', $id)->first();
            $lessons = $user->lessons()->get();
            $modules = [];
            foreach ($lessons as $key => $lesson) {
                $module = $lesson->module()->first();
    
                $user_lesson = $lesson->users()->where('user_id', $id)->first();
    
                $module["gotEC"] = $user_lesson->pivot->ec;
                $module["gotGrade"] = $user_lesson->pivot->grade;
    
                array_push($modules, $module);
            }
            foreach ($blocks as $key => $_block) {
                $totalEC = 0;
                $totalObtainedEC = 0;
                foreach ($modules as $key => $_module) {
                    if($_module->block_id == $_block->id){
                        $totalEC = $totalEC + $_module->ec;
                        $totalObtainedEC = $totalObtainedEC + $_module->gotEC;
                    }
                }
                $_block["totalEC"] = $totalEC;
                $_block["totalObtainedEC"] = $totalObtainedEC; 
            }

            foreach ($periods as $key => $period) {
                $periodBlocks = $blocks->where('period_id', $period->id);
                $period["blocks"] = $periodBlocks;
            }

            $progress = $this->calculateProgress($modules);
            return view('welcome')->with([
                'modules' => $modules,
                'periods' => $periods,
                'users' => $users,
                'chosenUser' => $user,
                'progress' => $progress,
                'totalEC' => 0,
                'totalObtainedEC' => 0,
            ]);
        }
    }

    public function calculateProgress($modules)
    {
        $totalEC = 0;
        $totalEarnedEC = 0;
        $progress = 0;
        foreach ($modules as $key => $module) {
            $totalEC = $totalEC + $module->ec;
            $totalEarnedEC = $totalEarnedEC + $module->gotEC;
        }
        if($totalEC > 0){
            $progress = $totalEarnedEC / $totalEC * 100;
        }
        return round($progress,2);
    }
}
