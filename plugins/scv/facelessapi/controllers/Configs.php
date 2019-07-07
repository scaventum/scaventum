<?php namespace scv\FacelessApi\Controllers;

use BackendMenu;
use Backend;

use scv\FacelessApi\Models\Client;
use scv\FacelessApi\Models\Config;
use scv\FacelessApi\Classes\ApiHelpers;
use scv\FacelessApi\Controllers\FacelessAPIController;

class Configs extends FacelessAPIController
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.configs' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-global', 'configs');
        $this->addJs("/plugins/scv/facelessapi/assets/js/clients.js", "1.0.0");
    }

    public function index(){
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        if(count($clients) === 1){
            return Backend::redirect("scv/facelessapi/configs/update/".$clients[0]);
        }
        
        parent::index();
    }

    public function create(){
        return Backend::redirect("scv/facelessapi/configs");
    }

    public function preview($recordId = NULL, $context = NULL, $model = NULL){
        parent::preview($recordId, $context, Config::class);
    }

    public function update($recordId = NULL, $context = NULL, $model = NULL){
        parent::update($recordId, $context, Config::class);
    }

    public function listExtendQuery($query, $definition = null) {
        parent::listExtendQuery($query, $definition);
    }

    public function onGenerateKey(){
        return ApiHelpers::generateClientKey(20);
    }
}
