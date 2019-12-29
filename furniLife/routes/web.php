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

/////////////////////


use App\Http\Controllers\CartController;
use App\Providers\RouteServiceProvider;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mine', 'MineController@mine');

Auth::routes();
Route::get('/password/forgot', 'ForgotPasswordController@forgot');


Route::get('/', 'IndexController@index');
Route::get('/{category_id}', 'SingleProductController@index');
Route::post('/{id}/review', 'SingleProductController@review');

Route::resource('/add_to_cart', 'CartController');
Route::post('/add_to_cart/home', 'CartController@store_home');
Route::get('/add_to_cart_quickly/{product_id}', 'CartController@store_quickly');
Route::get('/remove_to_cart_quickly/{product_id}', 'CartController@remove_quickly');
Route::get('/my_cart/show', 'CartController@my_cart');
Route::get('my_cart/show/{id}', 'CartController@cart_show_edit');
Route::get('my_cart/show/delete/{id}', 'CartController@cart_show_delete');
Route::get('/shop_list/{id}', 'ShoplistController@show');


Route::get('/checkout/show', 'CheckoutController@index');
Route::post('/checkout/continue/show', 'CheckoutController@continue');

Route::get('/dashboard/show', 'DashboardController@dashboard');
Route::post('/dashboard/show/accounts_changing', 'DashboardController@accounts_changing');
Route::post('/dashboard/show/complaint_sumbit', 'DashboardController@complaint_submit');

Route::get('/contactus/show', 'ContactUsController@index');
Route::post('/contactus/show/submit', 'ContactUsController@submit');

Route::get('/aboutus/show', 'AboutusController@index');

Route::get('search/{search}', 'SearchController@index');

// ADMIN PANNEL ROUTES ARE HERE //

Route::get('/admin/home', 'AdminController@index');
