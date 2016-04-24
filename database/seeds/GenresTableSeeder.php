<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('genres')->insert([
            'id' => 28,
            'genre' => 'Action',
            'genre_title' => 'action'
        ]);

        DB::table('genres')->insert([
            'id' => 12,
            'genre' => 'Adventure',
            'genre_title' => 'adventure'
        ]);

        DB::table('genres')->insert([
            'id' => 16,
            'genre' => 'Animation',
            'genre_title' => 'animation'
        ]);

        DB::table('genres')->insert([
            'id' => 35,
            'genre' => 'Comedy',
            'genre_title' => 'comedy'
        ]);

        DB::table('genres')->insert([
            'id' => 80,
            'genre' => 'Crime',
            'genre_title' => 'crime'
        ]);

        DB::table('genres')->insert([
            'id' => 99,
            'genre' => 'Documentary',
            'genre_title' => 'documentary'
        ]);

        DB::table('genres')->insert([
            'id' => 18,
            'genre' => 'Drama',
            'genre_title' => 'drama'
        ]);

        DB::table('genres')->insert([
            'id' => 10751,
            'genre' => 'Family',
            'genre_title' => 'family'
        ]);

        DB::table('genres')->insert([
            'id' => 14,
            'genre' => 'Fantasy',
            'genre_title' => 'fantasy'
        ]);

        DB::table('genres')->insert([
            'id' => 10769,
            'genre' => 'Foreign',
            'genre_title' => 'foreign'
        ]);

        DB::table('genres')->insert([
            'id' => 36,
            'genre' => 'History',
            'genre_title' => 'history'
        ]);

        DB::table('genres')->insert([
            'id' => 27,
            'genre' => 'Horror',
            'genre_title' => 'horror'
        ]);

        DB::table('genres')->insert([
            'id' => 10402,
            'genre' => 'Music',
            'genre_title' => 'music'
        ]);

        DB::table('genres')->insert([
            'id' => 9648,
            'genre' => 'Mystery',
            'genre_title' => 'mystery'
        ]);

        DB::table('genres')->insert([
            'id' => 10749,
            'genre' => 'Romance',
            'genre_title' => 'romance'
        ]);

        DB::table('genres')->insert([
            'id' => 878,
            'genre' => 'Science Fiction',
            'genre_title' => 'science-fiction'
        ]);

        DB::table('genres')->insert([
            'id' => 10770,
            'genre' => 'TV Movie',
            'genre_title' => 'tv-movie'
        ]);

        DB::table('genres')->insert([
            'id' => 53,
            'genre' => 'Thriller',
            'genre_title' => 'thriller'
        ]);

        DB::table('genres')->insert([
            'id' => 10752,
            'genre' => 'War',
            'genre_title' => 'war'
        ]);

        DB::table('genres')->insert([
            'id' => 37,
            'genre' => 'Western',
            'genre_title' => 'western'
        ]);
    }
}
