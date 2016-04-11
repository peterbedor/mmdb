<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use \GuzzleHttp\Client as Guzzle;

class MovieController extends Controller
{
	public static $cast;
	public static $movie;

	public static function getPopularTitles()
	{
		$movies = (new Guzzle())->get('http://api.themoviedb.org/3/movie/popular?api_key=' . env('API_KEY'));

		$response = json_decode($movies->getBody());

		if (count($response)) {
			return $response->results;
		}

		return false;
	}

	public static function getMovie($id)
	{
		$movie = (new Guzzle())->get('http://api.themoviedb.org/3/movie/' . $id . '?api_key=' . env('API_KEY'));

		if ($movie) {
			return json_decode($movie->getBody());
		}

		return false;
	}
}
