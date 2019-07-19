<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateScvFacelessapiClientBlocks extends Migration
{
    public function up()
    {
        Schema::create('scv_facelessapi_client_blocks', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('client_id')->unsigned();
            $table->integer('block_id');
            $table->primary(['client_id','block_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('scv_facelessapi_client_blocks');
    }
}
