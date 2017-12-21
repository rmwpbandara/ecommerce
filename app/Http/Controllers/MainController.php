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
        $stocks = Stock::all();
        //get recent records of products
        $recentStocks = Stock::orderBy('id', 'desc')->take(8)->get();
        $lowestPriceStocks = Stock::orderBy('price', 'asc')->take(8)->get();

        return view('home')->with(['tags'=>$tags,'types'=>$types, 'recentStocks'=>$recentStocks,'lowestPriceStocks'=>$lowestPriceStocks,'stocks'=>$stocks]);
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

        return view('shop')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types]);
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

    public function postProduct(Request $request){

        $authId = Auth::id();   //get auth user id

        $ProductId= DB::table('Stocks')->find(DB::table('Stocks')->max('id'))->id+1; //load database last id and + 1

        //request variables and save all
        $productName=$request->name;
        $productDescription=$request->description;
        $quantity=$request->quantity;
        $previousPrice=$request->previousPrice;
        $price=$request->price;
        $productType=$request->productType;

        //create front image name with auth id+product id + image name and request image
        $fileNameFrontImage = $authId.$ProductId.'frontImage'.'.jpg';
        $frontImage=$request->frontImage;
        if(!empty($frontImage)){
            $frontImage->move('images',$fileNameFrontImage);    //store image to 'images' folder in public folder
        }

        //create back image name with auth id+product id + image name and request image
        $backImage=$request->backImage;
        $fileNameBackImage = $authId.$ProductId.'backImage'.'.jpg';
        if(!empty($backImage)){
            $backImage->move('images',$fileNameBackImage);      //store image to 'images' folder in public folder
        }

        $stock = new Stock();                           //create new object Stock
        $stock->name=$productName;
        $stock->description=$productDescription;
        $stock->quantity=$quantity;
        $stock->previousPrice=$previousPrice;
        $stock->price=$price;
        $stock->image1Url=$fileNameFrontImage;
        $stock->image2Url=$fileNameBackImage;
        $stock->type_id=$productType;
        $stock->user_id=$authId;

        $stock->save();

        //save taggin to tagging table
        $tags = $request['states'];
        if (!empty($tags)):
            foreach ($tags as $tagStatesId => $tagId) {
                $tagging = new Tagging();
                $tagging->tag_id = $tagId;
                $tagging->stock_id=$ProductId;          //use product id to save tagging table product id column
                $tagging->save();
            }
        endif;

        $stock = Stock::all()->last();
        $type = Type::all()->last();
        $tags = Tag::all();
        $types = Type::all();

        return view('view_product')->with(['stock'=>$stock, 'type'=>$type,'tags'=>$tags,'types'=>$types]);
    }
}
