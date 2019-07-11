<?php namespace scv\FacelessApi;

use Event;
use Backend;
use Session;
use System\Classes\PluginBase;

use Backend\Models\User;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['Offline.Cors'];
    
    /**
     * @var bool Plugin requires elevated permissions.
     */
    public $elevated = true;

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
        // Redirect to config page after login
        Event::listen('backend.user.login', function($model) {
            Session::put('redirectAfterLogin', '/scv/facelessapi/configs');
        });

        Event::listen('backend.page.beforeDisplay', function($controller, $action, $params) {
            // .....
            if ($redirectAfterLogin = Session::pull('redirectAfterLogin', null)) {
                return Backend::redirect($redirectAfterLogin);
            }
        });

        User::extend(function($model) 
        {
            $model->belongsToMany['clients'] = ['scv\FacelessApi\Models\Client', 'table' => 'scv_facelessapi_client_users'];
        });
    }
}
