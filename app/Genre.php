<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
	public function movie()
	{
		$this->belongsToMany('App\Movie');
    }
}
