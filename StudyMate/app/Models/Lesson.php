<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function users(){
        return $this->belongsToMany('App\Models\User')->withPivot('grade', 'ec');
    }
    public function teacher(){
        return $this->belongsTo('App\Models\Teacher');
    }
    public function module(){
        return $this->belongsTo('App\Models\Module');
    }
}
