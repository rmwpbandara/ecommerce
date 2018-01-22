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

        $tags = Tag::all();
        $types = Type::all();

        if (Auth::check()) {
            $authId = Auth::id();
            $authShippingName = Auth::user()->shipping_name;
            $authShippingAddress = Auth::user()->shipping_address;
            $authShippingCountry = Auth::user()->shipping_country;


            return view('cart')->with(['tags' => $tags, 'types' => $types,'authShippingName'=>$authShippingName,'authId'=>$authId,'authShippingAddress'=>$authShippingAddress,'authShippingCountry'=>$authShippingCountry]);
        }
        return view('auth.login')->with(['tags' => $tags, 'types' => $types]);
    }

}
