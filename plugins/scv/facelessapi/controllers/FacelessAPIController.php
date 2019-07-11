<?php namespace scv\FacelessApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend;
use Session;

use scv\FacelessApi\Models\Client;

class FacelessAPIController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->addCss("/plugins/scv/facelessapi/assets/css/style.css", "1.0.0");
        $this->addJs("/plugins/scv/facelessapi/assets/js/script.js", "1.0.0");
    }

    // Authorize login user to related list
    public function listExtendQuery($query, $definition = null) {
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        $query->whereIn('client_id', $clients);
    }
    
    // Authorize login user to related form
    public function formExtendQuery($query)
    {
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        $query->whereIn('client_id',$clients);
    }

    public function onCheckClientSelector(){
        if(Session::has('activeClient')){
            return Client::with('config')->where('id',Session::get('activeClient'))->first();
        }
    }
}
