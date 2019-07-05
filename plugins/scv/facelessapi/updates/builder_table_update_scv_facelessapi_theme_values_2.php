<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiThemeValues2 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->integer('theme_id')->unsigned();
            $table->renameColumn('themecategory_id', 'theme_category_id');
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->dropColumn('theme_id');
            $table->renameColumn('theme_category_id', 'themecategory_id');
        });
    }
}
