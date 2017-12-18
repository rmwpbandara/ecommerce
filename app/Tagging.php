<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagging extends Model
{
    public function stock() {
        return $this->belongsTo('App\Stock');
    }

    public function tag() {
        return $this->belongsTo('App\Tag');
    }
}
