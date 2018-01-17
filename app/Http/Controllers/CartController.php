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

            return view('cart')->with(['tags' => $tags, 'types' => $types]);
        }
        return view('auth.login')->with(['tags' => $tags, 'types' => $types]);
    }

}
