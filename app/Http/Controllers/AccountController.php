<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function updateAccount(Request $request){

        $name = $request->name;
        $email = $request->email;
        $address = $request->address;
        $country = $request->country;
        $contactNo = $request->contactNo;

        $shipping_name = $request->shipping_name;
        $shipping_address = $request->shipping_address;
        $shipping_country = $request->shipping_country;

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        $profilePicture = $request->profilePicture;
        $coverPhoto = $request->coverPhoto;
//
//        dd($request->all());

        if(!empty($name)){
            DB::table('users')->where('id',Auth::id() )->update(['name' => $name]);
        }
        if(!empty($email)){
            DB::table('users')->where('id',Auth::id() )->update(['email' => $email]);
        }
        if(!empty($address)){
            DB::table('users')->where('id',Auth::id() )->update(['address' => $address]);
        }
        if(!empty($country)){
            DB::table('users')->where('id',Auth::id() )->update(['country' => $country]);
        }
        if(!empty($contactNo)){
            DB::table('users')->where('id',Auth::id() )->update(['contactNo' => $contactNo]);
        }


        if(!empty($shipping_name)){
            DB::table('users')->where('id',Auth::id() )->update(['shipping_name' => $shipping_name]);
        }
        if(!empty($shipping_address)){
            DB::table('users')->where('id',Auth::id() )->update(['shipping_address' => $shipping_address]);
        }
        if(!empty($shipping_country)){
            DB::table('users')->where('id',Auth::id() )->update(['shipping_country' => $shipping_country]);
        }


        if(!empty($old_password||$new_password||$confirm_password)){
            $data = $request->all();
            $user = User::find(auth()->user()->id);

            if(!Hash::check($data['old_password'], $user->password)){
                return back() ->withErrors('Current Password is does not match');
            }else{
                $this->validate($request, [
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password',
                ]);
                DB::table('users')->where('id',Auth::id() )->update(['password' => bcrypt($new_password)]);
            }
        }

        $authId=Auth::id();

        if (!empty($profilePicture)) {
            $profilePictureName = $authId . 'profilePic' . '.jpg';
            $profilePicture->move('images/profile-pictures', $profilePictureName);
        }

        if (!empty($coverPhoto)) {
            $coverPhotoName = $authId . 'coverPhoto' . '.jpg';
            $coverPhoto->move('images/cover-photos', $coverPhotoName);
        }
        return back()->with('message','Account Update is Success');
    }
}

