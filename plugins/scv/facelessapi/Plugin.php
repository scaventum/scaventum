<?php namespace scv\FacelessApi;

use System\Classes\PluginBase;
use Backend\Models\User;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function($model) 
        {
            $model->belongsToMany['clients'] = ['scv\FacelessApi\Models\Client', 'table' => 'scv_facelessapi_client_users'];
        });
    }
}
