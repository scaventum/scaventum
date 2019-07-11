<?php namespace Scv\FacelessApi\Controllers;

use BackendMenu;
use BackendAuth;
use Backend\Classes\Controller;

use scv\FacelessApi\Models\Client;

/**
 * Client Selector Back-end Controller
 */
class ClientSelector extends Controller
{
    public $implement = [
        'Backend.Behaviors.ListController'
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-admin', 'client-selector');
        $this->addJs("/plugins/scv/facelessapi/assets/js/clients.js", "1.0.0");
    }

    public function listExtendQuery($query, $definition = null) {
        $clients = array_keys(Client::clientsByUser($this->user->id)->pluck('name','id')->toArray());
        
        $query->whereIn('id', $clients);
    }

    public function onToggleActive(){
        $id = intval(post('id'));
        $active = intval(post('active'));

        Client::toggleSessionActive($id, $active);

        return $this->listRefresh();
    }
}
