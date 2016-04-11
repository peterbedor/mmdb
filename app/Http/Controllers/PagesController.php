<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \GuzzleHttp\Client as Guzzle;

class PagesController extends Controller
{
	public function index()
	{
		return view('pages.index')
			->with([
				'popularTitles' => MovieController::getPopularTitles(),
				'config' => $this->config
			]);
    }
}
