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


Route::get('/', 'IndexController@index')->name('home');
Route::get('/aboutus/show', 'AboutusController@index');
Route::get('search/{search}', 'SearchController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/contactus/show', 'ContactUsController@index');
    Route::post('/contactus/show/submit', 'ContactUsController@submit');
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
    // PAYMENT METHODS ARE HERE //

    Route::get('/payment/method/card', 'PaymentMethodTypeController@index');
    Route::post('/payment/method/card/deduction', 'PaymentMethodTypeController@deduction')->name('payment.deduction');

// Profile Checking can delete after development//

    Route::get('/payment_controller/show', 'PaymentController@index');
});
// ADMIN PANNEL ROUTES ARE HERE //

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/home', 'AdminController@index')->name('admin.home');
    Route::get('/admin/home/product/create', 'AdminProductController@create')->name('product.create');
    Route::post('/admin/home/product/store', 'AdminProductController@store')->name('product.store');
    Route::get('/admin/home/product/edit/{id}', 'AdminProductController@edit')->name('product.edit');
    Route::patch('/admin/home/product/update/{id}', 'AdminProductController@update')->name('product.update');
    Route::get('/admin/home/product/destroy/{id}', 'AdminProductController@destroy')->name('product.destroy');
    Route::get('/admin/home/product/all_products/show', 'AdminProductController@show_all_products')->name('product.show_all_products');

    Route::get('/admin/home/manage_orders', 'AdminManageOrdersController@orders')->name('manage_orders');
    Route::get('/admin/home/manage_orders/delivered/{id}', 'AdminManageOrdersController@product_delivered')->name('product.delivered');

    Route::get('/admin/home/complaints_box/', 'AdminComplaintsController@all_complaints')->name('complaints_box');
    Route::get('/admin/home/complaint/read/{id}', 'AdminComplaintsController@complaint_read')->name('complaint.read');
    Route::get('/admin/home/complaint/destroy/{id}', 'AdminComplaintsController@complaint_destroy')->name('complaint.destroy');

});


