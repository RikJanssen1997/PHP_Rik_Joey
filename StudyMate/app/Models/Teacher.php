<?php

namespace App\Models;

use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use Encryptable;
    
    protected $encryptable = [
        'name'
    ];
    public function teaching(){
        return $this->belongsToMany('App\Models\Module', 'teaching')->withPivot('coordinator');
    }
    public function lessons(){
        return $this->hasMany('App\Models\Lesson');
    }
}
