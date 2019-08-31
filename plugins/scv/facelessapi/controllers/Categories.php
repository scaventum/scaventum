<?php namespace scv\FacelessApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

use scv\FacelessApi\Controllers\FacelessAPIController;
use scv\FacelessApi\Models\Block;

class Categories extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.categories' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-pages', 'categories');
    }
}
