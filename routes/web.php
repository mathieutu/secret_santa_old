<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', 'RegisterController@redirectToProvider')->name('register');
Route::get('confirmation', 'RegisterController@handleProviderCallback');
