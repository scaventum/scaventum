<?php namespace scv\FacelessApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateScvFacelessapiClients2 extends Migration
{
    public function up()
    {
        Schema::table('scv_facelessapi_clients', function($table)
        {
            $table->text('key')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('scv_facelessapi_clients', function($table)
        {
            $table->string('key', 200)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
