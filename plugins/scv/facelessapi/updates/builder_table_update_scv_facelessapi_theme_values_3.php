<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiThemeValues3 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->decimal('value_number', 20, 4);
            $table->string('value_color', 7);
            $table->text('value_media');
            $table->renameColumn('value', 'value_text');
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_theme_values', function($table)
        {
            $table->dropColumn('value_number');
            $table->dropColumn('value_color');
            $table->dropColumn('value_media');
            $table->renameColumn('value_text', 'value');
        });
    }
}
