<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public function Blocks(){
        return $this->hasMany('App\Models\Block');
    }
}
