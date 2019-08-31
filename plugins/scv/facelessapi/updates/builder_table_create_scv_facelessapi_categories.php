<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvFacelessapiCategories extends Migration
{
    public function up()
    {
        Schema::create('scv_facelessapi_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('code', 50);
            $table->string('name', 50);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('client_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_facelessapi_categories');
    }
}
