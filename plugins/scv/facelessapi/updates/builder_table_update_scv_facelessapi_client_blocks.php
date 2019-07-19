<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiClientBlocks extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_client_blocks', function($table)
        {
            $table->integer('block_id')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_client_blocks', function($table)
        {
            $table->integer('block_id')->unsigned(false)->change();
        });
    }
}
