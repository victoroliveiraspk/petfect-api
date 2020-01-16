<?php

Route::prefix('pets')->group(function() {
    Route::get('/', 'PetController@index');
    Route::get('/{id}', 'PetController@show');
    Route::post('/', 'PetController@store');
    Route::put('/{id}', 'PetController@update');
    Route::delete('/{id}', 'PetController@destroy');
});