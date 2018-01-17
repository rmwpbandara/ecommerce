<?php

namespace App\Http\Controllers;

use App\Favourite;
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
        $recentStocks = DB::table('stocks')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
            ->select('stocks.*', 'users.name as seller_name', 'users.country', 'users.email as seller_email','type')
            ->orderBy('id', 'desc')->take(20)->get();

        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            $favourites = DB::table('favourites')->where('user_id', $authId)->pluck('stock_id')->toArray();

            return view('home')->with(['tags'=>$tags,'recentStocks'=>$recentStocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry,'favourites'=>$favourites]);
        }
        return view('home')->with(['tags'=>$tags,'recentStocks'=>$recentStocks, 'types'=>$types,'authId'=>0,'authCountry'=>'null','favourites'=>[]]);

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
        $types = Type::all();
        $stocks = DB::table('stocks')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
            ->select('stocks.*', 'users.name as seller_name', 'users.country', 'users.email as seller_email','type')
            ->orderBy('id', 'desc')
            ->get();

//        dd($stocks);

        if (Auth::check()) {

            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            $favourites = DB::table('favourites')->where('user_id', $authId)->pluck('stock_id')->toArray();

            return view('shop')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry,'favourites'=>$favourites]);
        }
        return view('shop')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>0,'authCountry'=>'null','favourites'=>[]]);
    }

    public function getSubscriptions(){
        $tags = Tag::all();
        $types = Type::all();

        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            $favourites = DB::table('favourites')->where('user_id', $authId)->pluck('stock_id')->toArray();
            $stocks = DB::table('stocks')
                ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
                ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
                ->select('stocks.*', 'users.name as seller_name', 'users.country', 'users.email as seller_email','type')
                ->get();

            $subscribes = DB::table('subscribes')
                ->where('auth_user_id',$authId)
                ->leftJoin('users', 'users.id', '=', 'subscribes.subscribes_user_id')
                ->get();

            return view('subscriptions')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry,'favourites'=>$favourites,'subscribes'=>$subscribes]);
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
        $authId = Auth::id();
        $tags = Tag::all();
        $types = Type::all();
        $user = DB::table('users')->select('*')->where('id', $authId)->get()->first();

        $stocks = DB::table('stocks')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
            ->select('stocks.*', 'users.name as seller_name', 'users.country', 'users.email as seller_email', 'type')
            ->get()
            ->where('user_id', $authId);

        if (Auth::check()) {
            return view('my_acount')->with(['tags'=>$tags,'types'=>$types,'authId'=>$authId,'user'=>$user,'stocks'=>$stocks]);
        }
        return view('auth.login')->with(['tags'=>$tags,'types'=>$types]);

    }
}
