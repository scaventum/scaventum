<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiThemeValues4 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->string('type', 50);
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->dropColumn('type');
        });
    }
}
