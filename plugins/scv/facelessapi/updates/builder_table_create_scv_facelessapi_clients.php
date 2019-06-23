<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvFacelessapiClients extends Migration
{
    public function up()
    {
        Schema::create('scv_facelessapi_clients', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 50);
            $table->string('domain', 200);
            $table->string('key', 50);
            $table->boolean('active');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_facelessapi_clients');
    }
}
