<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
