<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiPages2 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->text('seo_description');
            $table->text('seo_keywords');
            $table->string('seo_author', 50);
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_pages', function($table)
        {
            $table->dropColumn('seo_description');
            $table->dropColumn('seo_keywords');
            $table->dropColumn('seo_author');
        });
    }
}
