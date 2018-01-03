<?php
/**
 * Created by PhpStorm.
 * User: Wasantha
 * Date: 12/27/2017
 * Time: 4:27 PM
 */

namespace App\Libs;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Shipping{

    public static function getShipping($productId){

        $authUserCountry = Auth::user()->country;
        $productOwnerUserId = DB::table('stocks')->where('id',$productId)->value('user_id');
        $productOwnerCountry = DB::table('users')->where('id',$productOwnerUserId)->value('country');

        if($authUserCountry==$productOwnerCountry){

            $shippingCost = DB::table('stocks')->where('id',$productId)->value('shippingLocal');
            return $shippingCost;

        }
        else{
            $shippingCost = DB::table('stocks')->where('id',$productId)->value('shippingInternational');
            return $shippingCost;
        }

    }
}