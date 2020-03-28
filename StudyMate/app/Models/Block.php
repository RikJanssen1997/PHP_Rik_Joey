<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public function period(){
        return $this->belongsTo('App\Models\Period');
    }
    public function modules(){
        return $this->hasMany('App\Models\Module');
    }
}
