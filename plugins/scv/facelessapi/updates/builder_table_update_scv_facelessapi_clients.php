<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiClients extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_clients', function($table)
        {
            $table->string('key', 200)->change();
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_clients', function($table)
        {
            $table->string('key', 50)->change();
        });
    }
}
