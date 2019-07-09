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

    public function preview($recordId = NULL, $context = NULL, $model = NULL){
        parent::preview($recordId, $context, ThemeCategory::class);
    }

    public function update($recordId = NULL, $context = NULL, $model = NULL){
        parent::update($recordId, $context, ThemeCategory::class);
    }

    public function listExtendQuery($query, $definition = null) {
        parent::listExtendQuery($query, $definition);
    }
}
