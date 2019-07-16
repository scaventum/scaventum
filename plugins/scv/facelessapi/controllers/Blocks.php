<?php namespace scv\FacelessApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use scv\FacelessApi\Controllers\FacelessAPIController;

class Blocks extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.blocks' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-pages', 'blocks');
        $this->addCss("/plugins/scv/facelessapi/assets/css/style.css", "1.0.0");
        $this->addJs("/plugins/scv/facelessapi/assets/js/script.js", "1.0.0");
    }

    public function listExtendQuery($query, $definition = null) {
    }
    
    public function formExtendQuery($query){
    }
}
