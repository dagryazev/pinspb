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

Route::get('/', function () {
    return redirect('product');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product', 'ProductController@showView')->name('product');
Route::get('/product/{id}', 'ProductController@showUpdate')->name('productUpdate');


Route::post('/product/create', 'ProductController@create');
Route::post('/product/update', 'ProductController@update');
Route::get('/product/delete/{id}', 'ProductController@delete');
