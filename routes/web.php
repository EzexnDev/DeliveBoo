<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
Route::get('/', function(){
    return redirect('/home');
});

Route::get('/home', "RestaurantController@index");

Route::resource('restaurants','RestaurantController');

Route::get('menuitems/{menuitem}/delete','MenuItemController@delete')->name('menuitems.delete');
Route::get('menuitems/{menuitem}/toggle','MenuItemController@toggle')->name('menuitems.toggle');
Route::resource('menuitems','MenuItemController');

Route::get('dashboard','DashboardController@index')->name('dashboard');
Route::get('statistics','StatController@index')->name('statistics');

Route::post('cart', 'ItemToOrderController@getAddToCart')->name('add.item.cart');
Route::post('carts', 'ItemToOrderController@getReduceByOne')->name('reduce.item.cart');
Route::delete('carts', 'ItemToOrderController@getRemoveItem')->name('delete.item.cart');
Route::post('cartss', 'ItemToOrderController@checkCart')->name('check.cart');

/* Route::get('checkout','PaymentController@index'); */
/* Route::post("/checkout", "PaymentController@checkout"); */
/* Route::get('checkout','CheckoutController@checkout'); */
Route::post('result','PaymentController@checkout')->name('result.message');
Route::post("destroy","apiDestroyController@delete");

Route::resource('orders','OrderController');
 
Auth::routes();


