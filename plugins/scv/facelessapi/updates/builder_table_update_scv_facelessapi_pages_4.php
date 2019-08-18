<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiPages4 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->text('blocks')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->text('blocks')->nullable(false)->change();
        });
    }
}
