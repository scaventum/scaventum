<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiBlocks extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_blocks', function($table)
        {
            $table->integer('client_id')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_blocks', function($table)
        {
            $table->dropColumn('client_id');
        });
    }
}
