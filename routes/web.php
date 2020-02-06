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

use App\Product;

Route::get('/', function () {
    return view('welcome');
});
Route::get('lang/{lang?}',['as'=>'local.change', 'uses'=>'Back\LangController@change'],);

Route::get('back','Back\DashboardController@index');

Route::get('sregister','Back\SellerController@create')->name('seller.create');
Route::post('sregister','Back\SellerController@store')->name('seller.store');
Auth::routes(['register'=>false]);

// Route::get('test',function(){
//     $product = Product::findOrFail(1);

//     dd($product->shops()->attach('2',['quantity'=>12]));
// });

Route::get('/home', 'HomeController@index')->name('home');



