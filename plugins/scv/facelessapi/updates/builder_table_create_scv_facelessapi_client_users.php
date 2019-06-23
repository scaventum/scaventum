<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvFacelessapiClientUsers extends Migration
{
    public function up()
    {
        Schema::create('scv_facelessapi_client_users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->primary(['client_id','user_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_facelessapi_client_users');
    }
}
