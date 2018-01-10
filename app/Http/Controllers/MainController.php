<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Tag;
use App\Tagging;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MainController extends Controller
{
    public  function getHome(){
        $tags = Tag::all();
        $types = Type::all();
        //get recent records of products
        $stocks = Stock::orderBy('id', 'desc')->take(20)->get();

        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            return view('home')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry]);

        }
        return view('home')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>0,'authCountry'=>'null']);

    }

    public function getLogin(){
        $tags = Tag::all();
        $types = Type::all();
        return view('auth.login')->with(['tags'=>$tags,'types'=>$types]);
    }

    public function getRegister(){
        $tags = Tag::all();
        $types = Type::all();
        return view('auth.register')->with(['tags'=>$tags,'types'=>$types]);
    }

    public function getShop(){
        $tags = Tag::all();
        $stocks = Stock::all();
        $types = Type::all();

        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            return view('shop')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry]);

        }

        return view('shop')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>0,'authCountry'=>'null']);
    }

    public function getSubscriptions(){
        $tags = Tag::all();
//        $stocks = Stock::all();
        $stocks = Stock::all()->toArray();
        $types = Type::all();
        $users = User::all();

        if (Auth::check()) {

            return view('subscriptions')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types, 'users'=>$users]);
        }
        return view('auth.login')->with(['tags'=>$tags,'types'=>$types]);
    }

    public function getMyOrders(){
        $tags = Tag::all();
        $stocks = Stock::all();
        $types = Type::all();
        $users = DB::table('users')->simplePaginate(2);
        if (Auth::check()) {
            return view('my_orders')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'users'=>$users]);
        }
        return view('auth.login')->with(['tags'=>$tags,'types'=>$types]);
    }

    public function getSell(){
        $tags = Tag::all();
        $types = Type::all();
        if (Auth::check()) {
            return view('sell')->with(['tags'=>$tags,'types'=>$types]);
        }
        return view('auth.login')->with(['tags'=>$tags,'types'=>$types]);
    }

    public function getMyAccount()
    {
        return view('my_acount');
    }

}
