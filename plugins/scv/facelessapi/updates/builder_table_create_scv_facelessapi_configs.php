<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvFacelessapiConfigs extends Migration
{
    public function up()
    {
        Schema::create('scv_facelessapi_configs', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('site_name', 50);
            $table->text('site_description');
            $table->string('site_locale', 50);
            $table->string('site_timezone', 50);
            $table->boolean('online');
            $table->text('site_address');
            $table->integer('client_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_facelessapi_configs');
    }
}
