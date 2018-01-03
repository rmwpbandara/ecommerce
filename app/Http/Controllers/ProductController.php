<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function postSearch(Request $request){

//        dd($request->all());
        $tagIds = $request['tagId'];
        $typeIds = $request['typeId'];
        $lowerPrice = $request->lowerPrice;
        $upperPrice = $request->upperPrice;

//        dd($typeIds);

        $tags = Tag::all();
        $types = Type::all();
        $stocks = DB::table('stocks')->leftJoin('users', 'stocks.user_id', '=', 'users.id')->get();


//        dd($stocks);




        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            return view('search_results')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry,'typeIds'=>$typeIds]);
        }
        return view('search_results')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>0,'authCountry'=>'null','typeIds'=>$typeIds]);
    }

}
