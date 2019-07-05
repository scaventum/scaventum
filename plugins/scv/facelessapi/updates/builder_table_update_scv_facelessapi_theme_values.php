<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiThemeValues extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->renameColumn('theme_id', 'themecategory_id');
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->renameColumn('themecategory_id', 'theme_id');
        });
    }
}
