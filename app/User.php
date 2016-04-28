<?php

namespace App;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }

    public function getMovieIds()
    {
        $ids = [];

        $query = DB::table('movies')
            ->select('tmdb_id')
            ->join('movie_user', 'movies.id', '=', 'movie_user.movie_id')
            ->where('movie_user.user_id', Auth::user()->id)
            ->get();

        foreach ($query as $id) {
            $ids[] = $id->tmdb_id;
        }

        return $ids;
    }
}
