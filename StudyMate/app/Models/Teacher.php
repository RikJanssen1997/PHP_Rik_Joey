<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function teaching(){
        return $this->belongsToMany('App\Models\Module', 'teaching')->withPivot('coordinator');
    }
    public function lessons(){
        return $this->hasMany('App\Models\Lesson');
    }
}
