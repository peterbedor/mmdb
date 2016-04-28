<?php

namespace App\Http\Controllers;

use DB;
use App\Movie;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
	public function letter($letter)
	{
		$movies = Auth::user()
			->movies()
			->where('title', 'like', $letter . '%')
			->orderBy('title', 'ASC')
			->paginate(10);

		$data = [
			'movies' => $movies
		];

		return view('search.results')
			->with('data', $data);
    }

	public function genre($genre)
	{
		$data = [];

		$movies = Movie::getByGenre($genre);

		if (count($movies)) {
			$data = [
				'movies' => $movies,
				'title' => $movies[0]->genre
			];
		}

		return view('search.results')
			->with('data', $data);
	}

	public function search(Request $request)
	{
		$query = $request->input('query');

		$movies = Auth::user()
			->movies()
			->where('title', 'like', '%' . $query . '%')
			->orderBy('title', 'ASC')
			->paginate(10);

		if (count($movies)) {
			return $movies;
		}
	}

	public function autocomplete(Request $request)
	{
		$query = $request->input('q');

		$movies = Auth::user()
			->movies()
			->where('title', 'like', $query . '%')
			->orderBy('title', 'ASC')
			->limit(10)
			->get();

		return $movies;
	}
}
