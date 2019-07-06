<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiThemeCategories2 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_theme_categories', function($table)
        {
            $table->string('code', 50);
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_theme_categories', function($table)
        {
            $table->dropColumn('code');
        });
    }
}
