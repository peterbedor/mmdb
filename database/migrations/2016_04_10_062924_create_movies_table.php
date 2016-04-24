<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
			$table->increments('id')
				->unsigned()
				->index();
			$table->integer('tmdb_id')
				->unsigned();
			$table->string('imdb_id');
			$table->string('title');
			$table->text('overview');
			$table->string('tagline');
			$table->integer('runtime');
			$table->string('release_date');
			$table->string('slug');
			$table->string('poster_path');
			$table->string('backdrop_path');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('movies');
    }
}
