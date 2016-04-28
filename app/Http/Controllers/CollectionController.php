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
	public function index()
	{
		$movies = Auth::user()
			->movies()
			->orderBy('title', 'ASC')
			->paginate(10);

		if (count($movies)) {
			return view('collection.home')
				->with('movies', $movies);
		}

		return view('collection.home');
	}

	/**
	 * @param string $slug
	 * @return mixed
	 */
	public function single($slug)
	{
		$movie = Movie::where('slug', $slug)
			->with('genres')
			->first();

		if (count($movie)) {
			return view('collection.single')
				->with([
					'movie' => $movie,
					'config' => MovieController::getConfiguration(),
					'credits' => MovieController::getCredits($movie->tmdb_id),
				]);
		}

		return abort('404');
	}

	public function remove($id)
	{
		$movie = Movie::find($id);

		Auth::user()->movies()->detach($movie);

		return redirect('/collection');
	}
}
