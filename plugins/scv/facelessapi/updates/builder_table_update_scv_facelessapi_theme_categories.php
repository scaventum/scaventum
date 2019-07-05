<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiThemeCategories extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_theme_categories', function($table)
        {
            $table->integer('client_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_theme_categories', function($table)
        {
            $table->dropColumn('client_id');
        });
    }
}
