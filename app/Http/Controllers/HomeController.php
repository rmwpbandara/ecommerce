<?php

namespace App\Http\Controllers;

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
        return view('home')->with(['tags'=>$tags,'types'=>$types]);

//        return view('home');
    }
}
