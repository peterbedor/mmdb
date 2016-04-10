<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \GuzzleHttp\Client as Guzzle;

class PagesController extends Controller
{
	public function index()
	{
		$popularTitles = $this->getPopularTitles();

		return view('pages.index')
			->with([
				'popularTitles' => $popularTitles->results,
				'config' => $this->config
			]);
    }

	private function getPopularTitles()
	{
		$movies = (new Guzzle())->get('http://api.themoviedb.org/3/movie/popular?api_key=' . $this->apiKey);

		return json_decode($movies->getBody());
	}
}
