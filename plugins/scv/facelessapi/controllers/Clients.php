<?php namespace scv\FacelessApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Clients extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend.Behaviors.RelationController',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.clients' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api', 'clients');
        $this->addJs("/plugins/scv/facelessapi/assets/js/clients.js", "1.0.0");
        $this->addCss("/plugins/scv/facelessapi/assets/css/style.css", "1.0.0");
    }
}
