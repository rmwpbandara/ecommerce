<?php

namespace App\Http\Controllers;

use App\Favourite;
use App\Stock;
use App\Tag;
use App\Tagging;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


    public function postProduct(Request $request){

        $authId = Auth::id();   //get auth user id
        $ProductId= DB::table('Stocks')->find(DB::table('Stocks')->max('id'))->id+1; //load database last id and + 1

        $productName=$request->name;
        $productDescription=$request->description;
        $quantity=$request->quantity;
        $previousPrice=$request->previousPrice;
        $price=$request->price;
        $productType=$request->productType;
        $shippingLocal=$request->shippingLocal;
        $shippingInternational=$request->shippingInternational;

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
        else{
            $fileNameBackImage=null;
        }

        if($shippingLocal==null){
            $shippingLocal=0;
        }
        else{
            $shippingLocal=$request->shippingLocal;
        }

        if($shippingInternational==null){
            $shippingInternational=0;
        }
        else{
            $shippingInternational=$request->shippingInternational;
        }

        $stock = new Stock();                           //create new object Stock
        $stock->productName=$productName;
        $stock->description=$productDescription;
        $stock->quantity=$quantity;
        $stock->previousPrice=$previousPrice;
        $stock->price=$price;
        $stock->shippingLocal=$shippingLocal;
        $stock->shippingInternational=$shippingInternational;
        $stock->image1Url=$fileNameFrontImage;
        $stock->image2Url=$fileNameBackImage;
        $stock->type_id=$productType;
        $stock->user_id=$authId;

        $stock->save();

        $message = 'success';

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

        return redirect()->route('viewProduct', ['productId' => $ProductId,'message'=>$message]);
    }



    public function getViewProduct(Request $request){

        $productId=$request->productId;
        $message = $request->message;
        $tags = Tag::all();
        $types = Type::all();

        $stock = DB::table('stocks')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->leftJoin('types', 'stocks.type_id', '=', 'types.id')
            ->select('stocks.*','users.name as seller_name','users.country','users.email as seller_email','type')
            ->get()
            ->where('id',$productId)->first();

        return view('view_product')->with(['tags'=>$tags,'types'=>$types,'stock'=>$stock,'message'=>$message]);
    }






    public function saveFavourite(Request $request){

        $authId = $request->authId;
        $productId = $request->productId;

        $dataSameUser = DB::table('favourites')->where('user_id',$authId)->where('stock_id',$productId)->get();
        print_r($dataSameUser->count());

        if(($dataSameUser->count())==null){

            DB::beginTransaction();

            try {
                $favourite = new Favourite();

                $favourite->user_id=$authId;
                $favourite->stock_id=$productId;

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
            }
            else{
                return response('Error save data in database');
            }
        }
        else{
            return response('same data in database');
        }
    }


    public function getFavourite(){
        return view('favourite');
    }





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
