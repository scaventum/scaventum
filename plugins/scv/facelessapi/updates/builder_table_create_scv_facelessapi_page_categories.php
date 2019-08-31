<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvFacelessapiPageCategories extends Migration
{
    public function up()
    {
        Schema::create('scv_facelessapi_page_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('category_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->primary(['category_id','page_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_facelessapi_page_categories');
    }
}
