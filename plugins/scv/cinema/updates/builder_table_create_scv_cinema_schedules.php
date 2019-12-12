<?php namespace Scv\Cinema\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvCinemaSchedules extends Migration
{
    public function up()
    {
        Schema::create('scv_cinema_schedules', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->dateTime('date_time');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_cinema_schedules');
    }
}
