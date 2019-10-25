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
//
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'MainController@index')->name('index');
Route::get('/catalog', 'MainController@catalog')->name('catalog');
Route::get('/catsolo/id{id}', 'MainController@catalogsolo')->name('catalog');
Route::get('/getcatalog', 'MainController@getcatalog');
Route::get('/getbrands', 'MainController@getbrands');
Route::get('/stock', 'MainController@stock')->name('stock');
Route::get('/stocksolo/id{id}', 'MainController@stocksolo')->name('stock');
Route::get('/contact', 'MainController@contact')->name('contact');

Route::get('/services', 'MainController@services')->name('services');


Route::post('/sendmessage', 'MainController@sendmessage');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
