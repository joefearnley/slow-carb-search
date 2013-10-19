<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'admin', 'before' => 'auth.admin'], function()
{
    Route::get('/', 'AdminController@showAdmin');

    Route::get('login', 'AdminController@showLogin');
    Route::post('login', 'AdminController@login');
    Route::get('logout', 'AdminController@logout');

    Route::get('food/list', 'AdminController@listFood');
    Route::get('food/edit/{id}', 'AdminController@editFood');
    Route::post('food/save', 'AdminController@saveFood');
    Route::get('food/add', 'AdminController@showAddFood');
    Route::post('food/add', 'AdminController@addFood');
});

Route::get('/', 'HomeController@index');

Route::get('/search', 'HomeController@index');
Route::post('/search', 'SearchController@findFood');

Route::group(['prefix' => 'api', 'before' => 'auth.basic'], function()
{
    Route::resource('food', 'FoodController');
    Route::get('food/all', 'FoodController@showAll');
    Route::get('food/search/{food}', 'FoodController@search');
});