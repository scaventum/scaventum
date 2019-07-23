<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiBlocks2 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_blocks', function($table)
        {
            $table->string('icon', 50);
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_blocks', function($table)
        {
            $table->dropColumn('icon');
        });
    }
}
