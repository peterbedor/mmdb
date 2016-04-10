<?php

Route::get('/', 'PagesController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
