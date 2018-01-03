<?php

namespace App\Http\Controllers;

use App\Libs\Shipping;
use App\Tag;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCart(){

//        dd($request->id);
        $tags = Tag::all();
        $types = Type::all();
        if (Auth::check()) {

//            $shippingCost = Shipping::getShipping(2);
//            dd($aaa);
            return view('cart')->with(['tags' => $tags, 'types' => $types]);
        }
        return view('auth.login')->with(['tags' => $tags, 'types' => $types]);
    }


//    public function postShippingCalculate(Request $request)
//    {
//        $aaa = Shipping::getShipping(2);
//
////        dd('aaaaaaaa');
//
//        dd($request->id);
//
//        return $aaa;
//
//    }

    public function test(){
        dd('sss');
    }
}
