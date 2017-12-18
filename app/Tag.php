<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tagging(){
        return $this->hasMany('App\Tagging');
    }
}
