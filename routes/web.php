<?php

Route::get('/', 'MainPageController@index');

// Route::get('bowser-1.jpg', 'TestController@imgJpg');
// Route::get('bowser-2.png', 'TestController@imgPng');
Route::get('test', 'TestController@index');
