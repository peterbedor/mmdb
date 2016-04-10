<?php

Route::get('/', 'PagesController@index');

Route::get('/config', 'ConfigurationController@store');

Route::auth();

Route::get('/home', 'HomeController@index');
