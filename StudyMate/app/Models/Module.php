<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function toughtBy(){
        return $this->belongsToMany('App\Models\Teacher', 'teaching')->withPivot('coordinator');
    }
    public function test(){
        return $this->belongsTo('App\Models\Test', 'test_id');
    }
    public function block(){
        return $this->belongsTo('App\Models\Test', 'block_id');
    }
    public function lessons(){
        return $this->hasMany('App\Models\Lesson');
    }

}
