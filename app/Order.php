<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function payment(){
        return $this->hasOne('App\Payment');
    }

    public function purchaseEntry(){
        return $this->hasMany('App\PurchaseEntry');
    }
}
