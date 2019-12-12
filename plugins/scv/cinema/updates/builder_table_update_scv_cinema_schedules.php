<?php namespace Scv\Cinema\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvCinemaSchedules extends Migration
{
    public function up()
    {
        Schema::table('scv_cinema_schedules', function($table)
        {
            $table->integer('movie_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('scv_cinema_schedules', function($table)
        {
            $table->dropColumn('movie_id');
        });
    }
}
