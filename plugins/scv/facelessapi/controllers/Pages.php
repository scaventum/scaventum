<?php namespace scv\FacelessApi\Controllers;

use BackendMenu;

use scv\FacelessApi\Controllers\FacelessAPIController;

class Pages extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.pages' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-pages', 'pages');
    }
}
