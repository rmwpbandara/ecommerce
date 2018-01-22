<?php

namespace App\Http\Controllers;

use App\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function sellerSubscribe(Request $request){

        $authId = $request->authId;
        $sellerId = $request->sellerId;

        $dataSameSubscribes = DB::table('subscribes')->where('auth_user_id',$authId)->where('subscribes_user_id',$sellerId)->get();

        if (($dataSameSubscribes->count()) == null) {

            DB::beginTransaction();
            try {
                $subscribes = new Subscribe();
                $subscribes->auth_user_id = $authId;
                $subscribes->subscribes_user_id = $sellerId;
                $subscribes->save();
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

            DB::table('subscribes')->where('auth_user_id',$authId)->where('subscribes_user_id',$sellerId)->delete();

        }

        return response('success');

    }


}
