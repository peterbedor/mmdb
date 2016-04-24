<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use \GuzzleHttp\Client as Guzzle;

class PagesController extends Controller
{
	/**
	 * @return mixed
	 */
	public function index()
	{
		$data = [
			'popularTitles' => MovieController::getPopularTitles(),
			'config' => self::getConfiguration()
		];

		return view('pages.index')->with($data);
    }

	/**
	 * @return mixed
	 */
	public function terms()
	{
		return view('pages.terms');
	}
}
