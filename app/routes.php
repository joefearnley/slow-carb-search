<?php

Route::group(['prefix' => 'admin', 'before' => 'auth.admin'], function()
{
    Route::get('/', 'AdminController@index');

    Route::get('food/list', 'AdminController@listFood');
    Route::get('food/edit/{id}', 'AdminController@editFood');
    Route::post('food/save', 'AdminController@saveFood');
    Route::get('food/add', 'AdminController@showAddFood');
    Route::post('food/add', 'AdminController@addFood');
});

Route::get('admin/login', 'AdminController@showLogin');
Route::post('admin/login', 'AdminController@login');
Route::get('admin/logout', 'AdminController@logout');

//Route::get('/', 'HomeController@index');

//Route::get('/search', 'HomeController@index');

Route::get('/', 'SearchController@search');

Route::get('/api/search', 'ApiController@search');