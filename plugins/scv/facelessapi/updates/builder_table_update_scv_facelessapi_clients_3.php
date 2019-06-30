<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiClients3 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_clients', function($table)
        {
            $table->text('description');
            $table->dropColumn('domain');
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_clients', function($table)
        {
            $table->dropColumn('description');
            $table->string('domain', 200);
        });
    }
}
