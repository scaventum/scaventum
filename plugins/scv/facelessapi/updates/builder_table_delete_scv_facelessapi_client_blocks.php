<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteScvFacelessapiClientBlocks extends Migration
{
    public function up()
    {
        Schema::dropIfExists('scv_facelessapi_client_blocks');
    }
    
    public function down()
    {
        Schema::create('scv_facelessapi_client_blocks', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('client_id')->unsigned();
            $table->integer('block_id')->unsigned();
            $table->primary(['client_id','block_id']);
        });
    }
}
