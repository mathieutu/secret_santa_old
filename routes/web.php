<?php

Route::get('/', 'Controller@home')->name('home');
Route::get('register', 'RegisterController@redirectToProvider')->name('register');
Route::get('confirmation', 'RegisterController@handleProviderCallback');
