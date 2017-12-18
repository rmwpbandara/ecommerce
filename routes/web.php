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


Route::get('/',[
    'uses'=>'MainController@getHome',
    'as'=>'home'
]);

Route::get('/home', 'HomeController@index');


Route::get('/login',[
    'uses'=>'MainController@getLogin',
    'as'=>'login'
]);

Route::get('/register',[
    'uses'=>'MainController@getRegister',
    'as'=>'register'
]);



//get subscriptions content
Route::get('/subscriptions',[
    'uses'=>'MainController@getSubscriptions',
    'as'=>'subscriptions'
]);

//get shop content
Route::get('/shop',[
    'uses'=>'MainController@getShop',
    'as'=>'shop'
]);


//get myorders content
Route::get('/myorders',[
    'uses'=>'MainController@getMyOrders',
    'as'=>'myorders'
]);

//get sell content
Route::get('/sell',[
    'uses'=>'MainController@getSell',
    'as'=>'sell'
]);

//get myaccount content
Route::get('/myaccount',[
    'uses'=>'MainController@getMyAccount',
    'as'=>'myaccount'
]);


//add new products to the site
Route::post('/addproduct',[
    'uses'=>'MainController@postProduct',
    'as'=>'addProduct'
]);
