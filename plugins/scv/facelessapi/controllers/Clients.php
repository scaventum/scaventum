<?php

namespace scv\FacelessApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

use scv\FacelessApi\Classes\ApiHelpers;

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
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-admin', 'clients');
        $this->addJs("/plugins/scv/facelessapi/assets/js/clients.js", "1.0.0");
    }

    public function onGenerateKey()
    {
        return ApiHelpers::generateClientKey(20);
    }
}
