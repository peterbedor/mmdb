<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use \GuzzleHttp\Client as Guzzle;

class MovieController extends Controller
{
	public static function getPopularTitles()
	{
		$movies = (new Guzzle())->get('http://api.themoviedb.org/3/movie/popular?api_key=' . env('API_KEY'));

		$response = json_decode($movies->getBody());

		return $response->results;
	}
}
