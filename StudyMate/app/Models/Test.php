<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    
    public function module(){
        return $this->hasOne('App\Models\Module');
    }
    public function testType(){
        return $this->belongsTo('App\Models\TestType', 'test_type_id');
    }
}
