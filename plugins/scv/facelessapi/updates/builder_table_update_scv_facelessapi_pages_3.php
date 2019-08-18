<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiPages3 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->text('preview_image')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->text('preview_image')->nullable(false)->change();
        });
    }
}
