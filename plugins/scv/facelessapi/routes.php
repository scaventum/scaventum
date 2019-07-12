<?php

Route::group(['prefix' => 'api/v1'], function () {

    // Route::post('clients', 'Scv\FacelessApi\Classes\ApiClients@index');
    Route::post('configs', 'Scv\FacelessApi\Classes\ApiConfigs@index');
    Route::post('themes', 'Scv\FacelessApi\Classes\ApiThemes@index');
    
});

Route::options('{all}', function (){})->where('all', '.*');

?>