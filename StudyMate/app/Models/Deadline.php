<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function tag(){
        return $this->belongsTo('App\Models\Tag');
    }
    public function lesson(){
        return $this->belongsTo('App\Models\Lesson');
    }
}
