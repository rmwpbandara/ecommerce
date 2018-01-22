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

    public static function shippingCost($productIds){

        $shippingCost = 0;
        $authId = Auth::id();
        $authUser = DB::table('users')->where('id',$authId)->get()->first();

        $sellerId = [];

        foreach($productIds as $productId){

            $seller = DB::table('stocks')->join('users', 'users.id','=','stocks.user_id')->where('stocks.id',$productId)->get()->first();

//            foreach($sellerId as $id){
//                if($id==$seller->id){
//
//                }
//
//                else{
                    $sellerId[] = $seller->id;
//                }
//            }
//
            if($authUser->shipping_country==$seller->country){
                $shippingCost = $shippingCost+$seller->shippingLocal;
            }
            else{
                $shippingCost = $shippingCost+$seller->shippingInternational;
            }

        }

        dd($sellerId);

        dd($shippingCost);


        return $shippingCost;



//        dd($authUser->shipping_country,$seller->country,$seller->shippingLocal);






    }
}