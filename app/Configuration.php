<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;

class Configuration extends Model
{
	protected $fillable = [
		'base_url',
		'secure_base_url',
		'backdrop_sizes',
		'logo_sizes',
		'poster_sizes',
		'profile_sizes',
		'still_sizes'
	];

	protected $table = 'configuration';

	public static function get()
	{
		$apiKey = env('API_KEY');

		$configuration = (new Guzzle())->get('http://api.themoviedb.org/3/configuration?api_key=' . $apiKey);

		$response = json_decode($configuration->getBody());

		$configurationData = [
			'base_url' => $response->images->base_url,
			'secure_base_url' => $response->images->secure_base_url,
			'backdrop_sizes' => implode(',', $response->images->backdrop_sizes),
			'logo_sizes' => implode(',', $response->images->logo_sizes),
			'poster_sizes' => implode(',', $response->images->poster_sizes),
			'profile_sizes' => implode(',', $response->images->profile_sizes),
			'still_sizes' => implode(',', $response->images->still_sizes)
		];

		return Configuration::firstOrCreate($configurationData);
	}
}
