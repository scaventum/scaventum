<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiPages extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->text('slug');
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
