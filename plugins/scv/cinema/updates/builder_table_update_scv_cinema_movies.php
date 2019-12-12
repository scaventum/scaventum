<?php namespace Scv\Cinema\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvCinemaMovies extends Migration
{
    public function up()
    {
        Schema::table('scv_cinema_movies', function($table)
        {
            $table->integer('sort_order')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('scv_cinema_movies', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
