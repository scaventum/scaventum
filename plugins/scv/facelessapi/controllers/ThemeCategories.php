<?php namespace scv\FacelessApi\Controllers;

use BackendMenu;

use scv\FacelessApi\Models\Client;
use scv\FacelessApi\Models\ThemeCategory;
use scv\FacelessApi\Controllers\FacelessAPIController;

class ThemeCategories extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.theme_categories' 
    ];
    
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-global', 'themes');
    }
}
