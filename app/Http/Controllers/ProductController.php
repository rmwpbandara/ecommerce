<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Tag;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function postSearch(Request $request){

        $typeIds = $request['typeId'];
        $tagIds = $request['tagId'];
        $lowerPrice = (int)$request->lowerPrice;
        $upperPrice = (int)$request->upperPrice;

        $tags = Tag::all();
        $types = Type::all();
        $data = DB::table('stocks')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
            ->leftJoin('taggings', 'stocks.id', '=', 'taggings.stock_id')
            ->leftJoin('tags', 'taggings.tag_id', '=', 'tags.id')
            ->select('stocks.*','users.name as seller_name','users.country','users.email as seller_email','type','tags.id as tag_id','tag_name')
            ->where([
                ['price', '>', $lowerPrice],
                ['price', '<', $upperPrice],
            ])
            ->orderBy('type_id')
            ->get();

        if(($typeIds==!null)&&($tagIds==!null)){
            $stocks =$data->whereIn('type_id', $typeIds)->whereIn('tag_id', $tagIds)->unique('id');
        }
        elseif($typeIds==!null){
            $stocks =$data->whereIn('type_id', $typeIds)->unique('id');
        }
        elseif($tagIds==!null){
            $stocks = $data->whereIn('tag_id', $tagIds)->unique('id');
           }
        else{
            $stocks = null;
        }

        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            return view('search_results')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry]);
        }

        return view('search_results')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>0,'authCountry'=>'null']);
    }

}
