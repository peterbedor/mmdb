<?php

// Pages
Route::get('/', 'PagesController@index');
Route::get('/terms-and-conditions', 'PagesController@terms');

Route::auth();

Route::group(['middleware' => ['auth', 'web']], function () {
	Route::get('collection', 'CollectionController@index');
	Route::get('collection/{slug}', 'CollectionController@single');

	Route::post('movie/search', 'MovieController@search');
	Route::get('movie/{id}', 'MovieController@fetch');
	Route::post('movie/add/{id}', 'MovieController@store');

	Route::get('collection/search/{letter}');
});