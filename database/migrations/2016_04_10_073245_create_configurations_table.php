<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration', function(Blueprint $table) {
            $table->increments('id');
            $table->string('base_url');
            $table->string('secure_base_url');
            $table->string('backdrop_sizes');
            $table->string('logo_sizes');
            $table->string('poster_sizes');
            $table->string('profile_sizes');
            $table->string('still_sizes');
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
        Schema::drop('configuration');
    }
}
