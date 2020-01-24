<?php

Route::prefix('auth')->group(function() {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::prefix('pets')->group(function() {
    Route::get('/', 'PetController@index');
    Route::get('/{id}', 'PetController@show');
    Route::post('/', 'PetController@store');
    Route::put('/{id}', 'PetController@update');
    Route::delete('/{id}', 'PetController@destroy');
});