<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Movie extends Model
{
    protected $fillable = [
        'tmdb_id',
        'imdb_id',
        'title',
        'overview',
        'tagline',
        'status',
        'runtime',
        'release_date',
        'slug',
        'poster_path',
        'backdrop_path'
    ];

    public function genres()
    {
        return $this->belongsToMany('App\Genre');
    }

	public function user()
	{
		return $this->belongsToMany('App\User');
	}

	public static function getByGenre($genre)
	{
		return DB::table('movies')
			->select(
				'movies.*',
				'genres.genre'
			)
			->join('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
			->join('movie_user', 'movie_user.movie_id', '=', 'movies.id')
			->join('genres', 'genre_movie.genre_id', '=', 'genres.id')
			->where('genres.genre_title', $genre)
			->where('movie_user.user_id', Auth::user()->id)
			->orderBy('movies.title', 'ASC')
			->paginate(10);
	}
}
