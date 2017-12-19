<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Tag;
use App\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::all();
        $types = Type::all();
        $stocks = Stock::all();
        $recentStocks = Stock::orderBy('id', 'desc')->take(4)->get();
        $lowerstPriceStocks = Stock::orderBy('price', 'asc')->take(4)->get();

        return view('home')->with(['tags'=>$tags,'types'=>$types, 'recentStocks'=>$recentStocks,'lowerstPriceStocks'=>$lowerstPriceStocks]);

//        return view('home');
    }
}
