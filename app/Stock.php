<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function stock() {
        return $this->belongsTo('App\Stock');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function type() {
        return $this->belongsTo('App\Type');
    }

    public function tag() {
        return $this->hasMany('App\Tagging');
    }

    public function favourite(){
        return $this->hasMany('App\Favourite');
    }

}
