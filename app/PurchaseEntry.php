<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseEntry extends Model
{
    public function order() {
        return $this->belongsTo('App\Order');
    }

    public function stock(){
        return $this->hasMany('App\Stock');
    }

}
