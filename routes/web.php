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

//load main page
Route::get('/',[
    'uses'=>'MainController@getMain',
    'as'=>'main'
]);

//onclick home button, load home content
Route::get('/welcome',[
    'uses'=>'MainController@getWelcome',
    'as'=>'welcome'
]);

//onclick subscriptions button, load subscriptions content
Route::get('/subscriptions',[
    'uses'=>'MainController@getSubscriptions',
    'as'=>'subscriptions'
]);

//onclick shop button, load shop content
Route::get('/shop',[
    'uses'=>'MainController@getShop',
    'as'=>'shop'
]);


//onclick myorders button, load myorders content
Route::get('/myorders',[
    'uses'=>'MainController@getMyOrders',
    'as'=>'myorders'
]);

//onclick sell button, load sell content
Route::get('/sell',[
    'uses'=>'MainController@getSell',
    'as'=>'sell'
]);

//onclick myaccount button, load myaccount content
Route::get('/myaccount',[
    'uses'=>'MainController@getMyAccount',
    'as'=>'myaccount'
]);



//add new products to the site
Route::post('/addproduct',[
    'uses'=>'MainController@postProduct',
    'as'=>'addProduct'
]);



Route::get('/home', 'HomeController@index');

