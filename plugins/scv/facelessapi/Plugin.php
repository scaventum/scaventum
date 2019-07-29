<?php namespace scv\FacelessApi;

use Event;
use Backend;
use BackendAuth;
use Session;
use System\Classes\PluginBase;

use Backend\Models\User;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['OFFLINE.CORS','RainLab.Builder'];
    
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
        $this->app['Illuminate\Contracts\Http\Kernel']
            ->pushMiddleware('Scv\FacelessApi\Classes\ApiMiddleware');

        // Redirect to config page after login
        Event::listen('backend.user.login', function($model) {

            if (BackendAuth::getUser()->role) {
                if (BackendAuth::getUser()->role->code === 'developer') {  
                    Session::put('redirectAfterLogin', 'scv/facelessapi/clientselector'); // Redirect to configs if user is admin
                }else{
                    Session::put('redirectAfterLogin', 'scv/facelessapi/pages'); // Redirect to configs by default
                }
            }
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
