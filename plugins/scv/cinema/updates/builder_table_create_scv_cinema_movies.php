<?php namespace Scv\Cinema\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvCinemaMovies extends Migration
{
    public function up()
    {
        Schema::create('scv_cinema_movies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->date('release_date');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_cinema_movies');
    }
}
