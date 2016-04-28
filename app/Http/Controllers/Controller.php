<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Configuration;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public $apiKey;

	public function __construct()
	{
		$this->apiKey = env('API_KEY');
		
		config(['app.uploadsPath' => $_SERVER['DOCUMENT_ROOT'] . '/uploads/']);
	}

	public static function getConfiguration()
	{
		$rawConfig = Configuration::get();

		$config = [
			'secureBaseUrl' => $rawConfig->secure_base_url,
			'backdropSizes' => [],
			'posterSizes' => [],
			'profileSizes' => [],
			'logoSizes' => [],
			'stillSizes' => []
		];

		foreach (explode(',', $rawConfig->backdrop_sizes) as $size) {
			$config['backdropSizes'][] = $size;
		}

		foreach (explode(',', $rawConfig->poster_sizes) as $size) {
			$config['posterSizes'][] = $size;
		}

		foreach (explode(',', $rawConfig->profile_sizes) as $size) {
			$config['profileSizes'][] = $size;
		}

		foreach (explode(',', $rawConfig->logo_sizes) as $size) {
			$config['logoSizes'][] = $size;
		}

		foreach (explode(',', $rawConfig->still_sizes) as $size) {
			$config['stillSizes'][] = $size;
		}

		return $config;
	}
}
