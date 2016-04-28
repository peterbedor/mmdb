<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\Genre;
use App\Movie;
use App\Http\Requests;
use \GuzzleHttp\Client as Guzzle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class MovieController extends Controller
{
	public static $movie;

	/**
	 * Get popular titles from API
	 * @return mixed
	 */
	public static function getPopularTitles()
	{
		$request = (new Guzzle())->get('http://api.themoviedb.org/3/movie/popular?api_key=' . env('API_KEY'));

		$response = json_decode($request->getBody());

		if (count($response)) {
			return $response->results;
		}

		return false;
	}

	/**
	 * Fetch movie from API
	 * @param integer $id
	 * @return mixed
	 */
	public static function fetch($id)
	{
		$request = (new Guzzle())->get('http://api.themoviedb.org/3/movie/' . $id . '?api_key=' . env('API_KEY'));

		$data = [
			'movie' => json_decode($request->getBody()),
			'credits' => self::getCredits($id),
			'collectionIds' => Auth::user()->getMovieIds(),
			'config' => self::getConfiguration()
		];

		return view('movie.single')
			->with($data);
	}

	public function store(Request $request)
	{
		$id = $request->tmdb_id;
		$slug = Str::slug($request->title);

		$data = [
			'title' => $request->title,
			'overview' => $request->overview,
			'imdb_id' => $request->imdb_id,
			'tmdb_id' => $id,
			'release_date' => $request->release_date,
			'tagline' => $request->tagline,
			'slug' => $slug
		];

		if (isset($request->poster) && ! empty($request->poster)) {
			$data['poster_path'] = $this->saveImage($request->poster, 'poster', $id);
		}

		if (isset($request->backdrop) && ! empty($request->backdrop)) {
			$data['backdrop_path'] = $this->saveImage($request->backdrop, 'backdrop', $id);
		}

		$movie = Movie::firstOrCreate($data);

		Auth::user()->movies()->attach($movie);

		// Check to see if genre is attached to movie before trying to insert
		$exists = DB::table('genre_movie')
				->select('movie_id')
				->count() > 0;

		if (count($request->genres) && ! $exists) {
			foreach ($request->genres as $id) {
				$genre = Genre::find($id);

				$movie->genres()->attach($genre);
			}
		}

		return redirect('/collection/' . $slug);
	}

	/**
	 * Search API
	 * @param Request $request
	 * @param int $page
	 * @return mixed
	 */
	public function search(Request $request, $page = 1)
	{
		$query = $request->input('query');
		$page = $request->input('page');

		$search = (new Guzzle())->get('http://api.themoviedb.org/3/search/movie?query=' . $query . '&api_key=' . env('API_KEY') . '&page=' . $page);

		$data = [
			'results' => json_decode($search->getBody()),
			'config' => self::getConfiguration()
		];

		return json_encode($data);
	}

	/**
	 * @param integer $id
	 * @return mixed
	 */
	public static function getCredits($id)
	{
		$request = (new Guzzle())->get('http://api.themoviedb.org/3/movie/' . $id . '/credits?api_key=' . env('API_KEY'));

		return json_decode($request->getBody());
	}

	/**
	 * @param integer $id
	 * @return mixed
	 */
	public static function getReview($id)
	{
		$request = (new Guzzle())->get('http://api.themoviedb.org/3/movie/' . $id . '/reviews?api_key=' . env('API_KEY'));

		return json_decode($request->getBody());
	}

	/**
	 * Save related images and return path
	 * @param string $image
	 * @param string $type
	 * @param integer $id
	 * @return string
	 */
	public function saveImage($image, $type, $id)
	{
		$newImage = Image::make($image);

		$imageDir = config('app.uploadsPath') . $id;

		if (! file_exists($imageDir)) {
			mkdir($imageDir);
		}

		$newImage->save($imageDir .  '/' . $type . '.jpg');

		return 'uploads/' . $id . '/' . $type . '.jpg';
	}
}
