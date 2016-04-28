<?php

// Pages
Route::get('/', 'PagesController@index');
Route::get('/terms-and-conditions', 'PagesController@terms');

// Set auth routes
Route::auth();

Route::group(['middleware' => ['auth', 'web']], function () {
	Route::get('collection', 'CollectionController@index');
	Route::get('collection/{slug}', 'CollectionController@single');
	Route::post('collection/remove/{id}', 'CollectionController@remove');

	Route::post('movie/search', 'MovieController@search');
	Route::get('movie/{id}', 'MovieController@fetch');
	Route::post('movie/add/{id}', 'MovieController@store');

	Route::get('person/{id}', 'PersonController@getCastMember');

	Route::get('collection/search/letter/{letter}', 'SearchController@letter');
	Route::get('collection/search/genre/{genre}', 'SearchController@genre');
	Route::post('collection/search', 'SearchController@search');
	Route::get('collection/search/autocomplete', 'SearchController@autocomplete');
});