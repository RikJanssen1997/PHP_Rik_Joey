<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    public function tests(){
        return $this->hasMany('App\Models\Test');
    }
}
