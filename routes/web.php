<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/comentar-user', 'DetailController@comment')->name('commentar');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

Route::get('/addongkir}', 'AddongkirController@checkout')->name('addongkir');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'CartController@success')->name('success');

Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');



Route::group(['middleware' => ['auth']], function(){
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::get('/dashboard/transactions', 'DashboardTransactionsController@index')->name
    ('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionsController@details')->name
    ('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionsController@update')->name
    ('dashboard-transactions-update');

    Route::get('/dashboard/account', 'DashboardSettingController@account')->name
    ('dashboard-settings-account');
     Route::get('/cities/{id}', 'DashboardSettingController@getCities');
    Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name
    ('dashboard-settings-redirect');
});

//

route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth' ,'admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');

        Route::resource('my-product', 'MyProductController');
        Route::post('/admin/products/{id}', 'MyProductController@update')->name
        ('my-products-update');
        Route::get('/admin/products/{id}', 'MyProductController@details')->name
        ('my-products-details');
        Route::post('/admin/products', 'MyProductController@store')->name
        ('my-products-store');
        Route::post('/admin/products/gallery/upload', 'MyProductController@uploadGallery')->name
        ('my-products-gallery-upload');
        Route::get('/admin/products/gallery/delete/{id}', 'MyProductController@deleteGallery')->name
        ('my-products-gallery-delete');

        Route::resource('my-transaction', 'MyTransactionsController');
        Route::get('/admin/transactions/{id}', 'MyTransactionsController@details')->name
        ('my-transactions-details');
        Route::post('/admin/transactions/{id}', 'MyTransactionsController@update')->name
        ('my-transactions-update');

        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
        Route::resource('transaction', 'TransactionController');
    });

Auth::routes();
