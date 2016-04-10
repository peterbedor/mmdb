<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use \GuzzleHttp\Client as Guzzle;

class ConfigurationController extends Controller
{
	/**
	 * Stores the API configuration
	 */
	public function store()
	{
		$apiKey = env('API_KEY');

		$configuration = (new Guzzle())->get('http://api.themoviedb.org/3/configuration?api_key=' . $apiKey);

		$response = json_decode($configuration->getBody());

		$sizes = [
			'backdrop' => $response->images->backdrop_sizes,
			'poster' => $response->images->poster_sizes,
			'profile' => $response->images->profile_sizes
		];

		config([
			'secureBaseUrl' => $response->secure_base_url,
			'baseUrl' => $response->base_url,
			'imageSize' => $sizes
		]);
    }
}
