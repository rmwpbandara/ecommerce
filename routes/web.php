<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('layouts.app');
//});

Auth::routes();

Route::get('/login',[
    'uses'=>'MainController@getLogin',
    'as'=>'login'
]);

Route::get('/register',[
    'uses'=>'MainController@getRegister',
    'as'=>'register'
]);


Route::get('/',[
    'uses'=>'MainController@getHome',
    'as'=>'home'
]);

Route::get('/home', 'HomeController@index');

Route::get('/shop',[
    'uses'=>'MainController@getShop',
    'as'=>'shop'
]);

Route::get('/subscriptions',[
    'uses'=>'MainController@getSubscriptions',
    'as'=>'subscriptions'
]);

Route::get('/myorders',[
    'uses'=>'MainController@getMyOrders',
    'as'=>'myorders'
]);

Route::get('/sell',[
    'uses'=>'MainController@getSell',
    'as'=>'sell'
]);

Route::get('/myaccount',[
    'uses'=>'MainController@getMyAccount',
    'as'=>'myaccount'
]);
Route::post('/updateAccount',[
    'uses'=>'AccountController@updateAccount',
    'as'=>'updateAccount'
]);

Route::get('/mycart',[
    'uses'=>'CartController@getCart',
    'as'=>'mycart'
]);


Route::post('/search',[
    'uses'=>'ProductController@postSearch',
    'as'=>'search'
]);


Route::post('/addproduct',[
    'uses'=>'ProductController@postProduct',
    'as'=>'addProduct'
]);

Route::get('/viewproduct',[
    'uses'=>'ProductController@getViewProduct',
    'as'=>'viewProduct'
]);


Route::post('/savefavourite',[
    'uses'=>'ProductController@saveFavourite',
    'as'=>'saveFavourite'
]);

Route::get('/viewfavourite',[
    'uses'=>'ProductController@getFavourite',
    'as'=>'viewFavourite'
]);


Route::post('/removeFavourite',[
    'uses'=>'ProductController@removeFromFavourite',
    'as'=>'removeFromFavourite'
]);


Route::post('/viewproductdetails',[
    'uses'=>'ProductController@viewProductDetails',
    'as'=>'viewProductDetails'
]);

Route::post('/editProduct',[
    'uses'=>'ProductController@editProduct',
    'as'=>'editProduct'
]);

Route::post('/updateProduct',[
    'uses'=>'ProductController@updateProduct',
    'as'=>'updateProduct'
]);

Route::post('/saveSubscribe',[
    'uses'=>'SellerController@sellerSubscribe',
    'as'=>'subscribe'
]);

