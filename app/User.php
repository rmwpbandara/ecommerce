<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','country', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function feedback(){
        return $this->hasMany('App\Feedback');
    }
    public function order(){
        return $this->hasMany('App\Order');
    }
    public function stock(){
        return $this->hasMany('App\Stock');
    }
    public function account(){
        return $this->hasMany('App\Account');
    }

    public function favourite(){
        return $this->hasMany('App\Favourite');
    }

    public function subscribe(){
            return $this->hasMany('App\subscribe');
    }

}
