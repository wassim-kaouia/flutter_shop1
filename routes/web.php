<?php

use App\User;
use App\Image;
use App\Product;

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
    return view('welcome');
});



// don't get access to this Route cause a data duplicate will occure 
// Route::get('/units-test','DataImportController@import');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth','user_is_admin']], function () {
    //units
    Route::get('units','UnitController@index')->name('units');
    Route::post('units','UnitController@store');
    Route::delete('units','UnitController@delete');
    Route::put('units','UnitController@update');
    Route::get('search-units','UnitController@search')->name('search-units');
    // Route::get('search-units','UnitController@index');

    //categories
    Route::get('categories','CategoryController@index')->name('categories');
    Route::post('categories','CategoryController@store');
    Route::delete('categories','CategoryController@delete');
    Route::put('categories','CategoryController@update');
    Route::get('search-categories','CategoryController@search')->name('search-categories');

    //products
    Route::get('products','ProductController@index')->name('products');
    //tags
    Route::get('tags','TagController@index')->name('tags');
    Route::post('tags','TagController@store');
    Route::put('tags','TagController@update');
    Route::delete('tags','TagController@delete');
    Route::get('search-tags','TagController@search')->name('search-tags');
    


    //shipments
    //payments
    //orders

    //countries
    Route::get('countries','CountryController@index')->name('countries');
    //cities
    Route::get('cities','CityController@index')->name('cities');
    //states
    Route::get('states','StateController@index')->name('states');


   
    //reviews
    Route::get('reviews','ReviewController@index')->name('reviews');
    //tickets
    Route::get('tickets','TicketController@index')->name('tickets');
    //roles
    Route::get('roles','RoleController@index')->name('roles');
    //users 
    Route::get('users','UserController@index')->name('users');
    Route::post('users','UserController@store');
    Route::put('users','UserController@update');
    Route::delete('users','UserController@delete');
    Route::get('search-users','UserController@search')->name('search-users');

});
