<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show collection
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$movies = Auth::user()
			->movies()
			->orderBy('title', 'ASC')
			->paginate(10);

		return view('collection.home')
			->with('movies', $movies);
	}

	public function single($slug)
	{
		$movie = Movie::where('slug', $slug)
			->with('genres')
			->first();

		return view('collection.single')
			->with('movie', $movie);
	}
}
