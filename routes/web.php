<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', 'Auth\AuthController@redirectToProvider')->name('register');
Route::get('confirmation', 'Auth\AuthController@handleProviderCallback');
