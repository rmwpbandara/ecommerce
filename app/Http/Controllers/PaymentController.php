<?php

namespace App\Http\Controllers;

use App\Libs\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function checkout(Request $request){

        $inputs = $request->all();
        $productIds = @$inputs['productId'];

        $totalShippingCost = Shipping::shippingCost($productIds);

        dd($totalShippingCost);

        $authId = Auth::id();
        $authUser = DB::table('users')->where('id',$authId)->get()->first();

        if(empty($authUser->shipping_country)){
            return 'not update shipping country';
        }else{

//            $totalShippingCost = 0;

//            foreach($productIds as $productId){
                $totalShippingCost = Shipping::shippingCost($productIds);
//            }

//            dd($totalShippingCost);

            return $totalShippingCost;
        }
    }
}
