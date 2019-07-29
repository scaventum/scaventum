<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvFacelessapiPages extends Migration
{
    public function up()
    {
        Schema::create('scv_facelessapi_pages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 50);
            $table->text('preview_title');
            $table->text('preview_subtitle');
            $table->text('preview_description');
            $table->text('preview_image');
            $table->boolean('active');
            $table->dateTime('active_begin')->nullable();
            $table->dateTime('active_end')->nullable();
            $table->integer('template_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->text('blocks');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_facelessapi_pages');
    }
}
