<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    public function account() {
        return $this->belongsTo('App\Account');
    }
}
