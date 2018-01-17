<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Stock;
use App\Subscribe;
use App\Tag;
use App\Tagging;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function postProduct(Request $request)
    {

        $authId = Auth::id();   //get auth user id
        $ProductId = DB::table('Stocks')->find(DB::table('Stocks')->max('id'))->id + 1; //load database last id and + 1

        $productName = $request->name;
        $productDescription = $request->description;
        $quantity = $request->quantity;
        $previousPrice = $request->previousPrice;
        $price = $request->price;
        $productType = $request->productType;
        $shippingLocal = $request->shippingLocal;
        $shippingInternational = $request->shippingInternational;

        //create front image name with auth id+product id + image name and request image
        $fileNameFrontImage = $authId . $ProductId . 'frontImage' . '.jpg';
        $frontImage = $request->frontImage;
        if (!empty($frontImage)) {
            $frontImage->move('images/product-images/front-images', $fileNameFrontImage);    //store image to 'images' folder in public folder
        }
        //create back image name with auth id+product id + image name and request image
        $backImage = $request->backImage;
        $fileNameBackImage = $authId . $ProductId . 'backImage' . '.jpg';
        if (!empty($backImage)) {
            $backImage->move('images/product-images/back-images', $fileNameBackImage);      //store image to 'images' folder in public folder
        } else {
            $fileNameBackImage = null;
        }

        if ($shippingLocal == null) {
            $shippingLocal = 0;
        } else {
            $shippingLocal = $request->shippingLocal;
        }

        if ($shippingInternational == null) {
            $shippingInternational = 0;
        } else {
            $shippingInternational = $request->shippingInternational;
        }

        $stock = new Stock();                           //create new object Stock
        $stock->productName = $productName;
        $stock->description = $productDescription;
        $stock->quantity = $quantity;
        $stock->previousPrice = $previousPrice;
        $stock->price = $price;
        $stock->shippingLocal = $shippingLocal;
        $stock->shippingInternational = $shippingInternational;
        $stock->image1Url = $fileNameFrontImage;
        $stock->image2Url = $fileNameBackImage;
        $stock->type_id = $productType;
        $stock->user_id = $authId;

        $stock->save();

        $message = 'success';

        //save taggin to tagging table
        $tags = $request['states'];
        if (!empty($tags)):
            foreach ($tags as $tagStatesId => $tagId) {
                $tagging = new Tagging();
                $tagging->tag_id = $tagId;
                $tagging->stock_id = $ProductId;          //use product id to save tagging table product id column
                $tagging->save();
            }
        endif;

        return redirect()->route('viewProduct', ['productId' => $ProductId, 'message' => $message]);
    }

    public function postSearch(Request $request)
    {
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
            ->select('stocks.*', 'users.name as seller_name', 'users.country', 'users.email as seller_email', 'type', 'tags.id as tag_id', 'tag_name')
            ->where([
                ['price', '>', $lowerPrice],
                ['price', '<', $upperPrice],
            ])
            ->orderBy('type_id')
            ->get();


        if (($typeIds == !null) && ($tagIds == !null)) {
            $stocks = $data->whereIn('type_id', $typeIds)->whereIn('tag_id', $tagIds)->unique('id');
        } elseif ($typeIds == !null) {
            $stocks = $data->whereIn('type_id', $typeIds)->unique('id');
        } elseif ($tagIds == !null) {
            $stocks = $data->whereIn('tag_id', $tagIds)->unique('id');
        } else {
            $stocks = null;
        }

        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            $favourites = DB::table('favourites')->where('user_id', $authId)->pluck('stock_id')->toArray();
            return view('search_results')->with(['tags' => $tags, 'stocks' => $stocks, 'types' => $types, 'authId' => $authId, 'authCountry' => $authCountry,'favourites'=>$favourites]);
        }
        return view('search_results')->with(['tags' => $tags, 'stocks' => $stocks, 'types' => $types, 'authId' => 0, 'authCountry' => 'null','$favourites'=>[]]);
    }

    public function getViewProduct(Request $request)
    {

        $productId = $request->productId;
        $message = $request->message;
        $tags = Tag::all();
        $types = Type::all();
        $stock = DB::table('stocks')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
            ->select('stocks.*', 'users.name as seller_name', 'users.country', 'users.email as seller_email', 'type')
            ->get()
            ->where('id', $productId)->first();

        return view('view_product')->with(['tags' => $tags, 'types' => $types, 'stock' => $stock, 'message' => $message]);
    }

    public function saveFavourite(Request $request)
    {

        $authId = $request->authId;
        $productId = $request->productId;
        $dataSameUser = DB::table('favourites')->where('user_id', $authId)->where('stock_id', $productId)->get();

        if (($dataSameUser->count()) == null) {

            DB::beginTransaction();
            try {
                $favourite = new Favourite();
                $favourite->user_id = $authId;
                $favourite->stock_id = $productId;
                $favourite->save();
                DB::commit();
                $success = true;
            } catch (\Exception $e) {
                $success = false;
                DB::rollback();
                print_r('error save');
            }

            if ($success) {
                return response('success');
            } else {
                return response('Error save data in database');
            }

        } else {
            return response('same data in database');
        }
    }

    public function getFavourite()
    {

        $tags = Tag::all();
        $types = Type::all();

        if (Auth::check()) {
            $authCountry = Auth::user()->country;
            $authId = Auth::id();
            $stocks = DB::table('stocks')
                ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
                ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
                ->leftJoin('favourites', 'favourites.stock_id', '=', 'stocks.id')
                ->select('stocks.*', 'users.name as seller_name', 'users.country', 'users.email as seller_email','type','favourites.user_id as favourite_user_id')
                ->get()->where('favourite_user_id', '=', $authId);

            return view('favourite')->with(['tags'=>$tags,'stocks'=>$stocks, 'types'=>$types,'authId'=>$authId,'authCountry'=>$authCountry]);
        }

        return view('auth.login')->with(['tags'=>$tags,'types'=>$types]);
    }

    public function removeFromFavourite(Request $request){

        $authId = $request->authId;
        $productId = $request->productId;
        DB::table('favourites')->where('user_id', $authId)->where('stock_id', $productId)->delete();
    }

//  --------------------------------------------------------------------------------------------------------------------product details

    public function viewProductDetails(Request $request){

        $productId = $request->productId;
        $sellerId = $request->sellerId;
//        $authId = $request->authId;

        $tags = Tag::all();
        $types = Type::all();

        $stock = DB::table('stocks')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
            ->select('stocks.*','users.name as seller_name','users.country as seller_country','users.email as seller_email','type')
            ->get()
            ->where('id',$productId)->first();


        if (Auth::check()) {
        $authCountry = Auth::user()->country;
        $authId = Auth::id();
        $subscribeCount = DB::table('subscribes')->where('auth_user_id', $authId)->where('subscribes_user_id',$sellerId)->get()->count();

        $favourites = DB::table('favourites')->where('user_id', $authId)->pluck('stock_id')->toArray();

        return view('view_product_details')->with(['tags'=>$tags,'types'=>$types,'stock'=>$stock,'authCountry'=>$authCountry,'authId'=>$authId,'favourites'=>$favourites,'subscribeCount'=>$subscribeCount]);
        }
    return view('view_product_details')->with(['tags'=>$tags,'types'=>$types,'stock'=>$stock,'authCountry'=>0,'authId'=>0,'favourites'=>[],'subscribeCount'=>0]);

    }

//  --------------------------------------------------------------------------------------------------------------------edit products
    public function editProduct(Request $request){

        $productId = $request->productId;
        $stock = DB::table('stocks')->select('*')->where('id', $productId)->get()->first();
        $taggings = DB::table('taggings')->leftJoin('tags', 'taggings.tag_id', '=', 'tags.id')
            ->select('taggings.*','tag_name')
            ->get()
            ->where('stock_id',$productId);
        $tags = Tag::all();
        $types = Type::all();
        return view('edit_product')->with(['tags'=>$tags,'types'=>$types,'stock'=>$stock,'taggings'=>$taggings]);

    }

    public function updateProduct(Request $request){


        $authId = Auth::id();
        $productId = $request->productId;

//        dd($request->all());
        $productType = $request->productType;
        $productName = $request->productName;
        $productDescription = $request->description;
        $price = $request->price;
        $quantity = $request->quantity;
        $previousPrice = $request->previousPrice;
        $shippingLocal = $request->shippingLocal;
        $shippingInternational = $request->shippingInternational;
        $frontImage = $request->frontImage;
        $backImage = $request->backImage;


        if(!empty($productType)){
            DB::table('stocks')->where('id',$productId)->update(['type_id' => $productType]);
        }
        if(!empty($productName)){
            DB::table('stocks')->where('id',$productId)->update(['productName' => $productName]);
        }
        if(!empty($productDescription)){
            DB::table('stocks')->where('id',$productId)->update(['description' => $productDescription]);
        }
        if(!empty($price)){
            DB::table('stocks')->where('id',$productId)->update(['price' => $price]);
        }
        if(!empty($quantity)){
            DB::table('stocks')->where('id',$productId)->update(['quantity' => $quantity]);
        }
        if(!empty($previousPrice)){
            DB::table('stocks')->where('id',$productId)->update(['previousPrice' => $previousPrice]);
        }

        if (!empty($frontImage)) {
            $fileNameFrontImage = $authId . $productId . 'frontImage' . '.jpg';
            $frontImage->move('images/product-images/front-images', $fileNameFrontImage);
        }
        if (!empty($backImage)) {
            $fileNameBackImage = $authId . $productId . 'backImage' . '.jpg';
            $backImage->move('images/product-images/back-images', $fileNameBackImage);
        }

        if ($shippingLocal == null) {
            DB::table('stocks')->where('id',$productId)->update(['shippingLocal' => 0]);
        } else {
            DB::table('stocks')->where('id',$productId)->update(['shippingLocal' => $shippingLocal]);
        }

        if ($shippingInternational == null) {
            DB::table('stocks')->where('id',$productId)->update(['shippingInternational' => 0]);
        } else {
            DB::table('stocks')->where('id',$productId)->update(['shippingInternational' => $shippingInternational]);
        }

        $message = 'success';

//        //save taggin to tagging table

        DB::table('taggings')->where('stock_id',$productId )->delete();

        $tags = $request['states'];
        if (!empty($tags)){
            foreach ($tags as $tagStatesId => $tagId) {
            $tagging = new Tagging();
            $tagging->tag_id = $tagId;
            $tagging->stock_id = $productId;          //use product id to save tagging table product id column
            $tagging->save();}
        } else{

        }

        return redirect()->route('viewProduct', ['productId' => $productId, 'message' => $message]);
    }



}
