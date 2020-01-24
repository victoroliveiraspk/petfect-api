<?php

Route::prefix('auth')->group(function() {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::group(['prefix' => 'pets'], function() {
    Route::get('/', 'PetController@index');
    Route::get('/{id}', 'PetController@show');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('/', 'PetController@store');
        Route::put('/{id}', 'PetController@update');
        Route::delete('/{id}', 'PetController@destroy');
    });
});