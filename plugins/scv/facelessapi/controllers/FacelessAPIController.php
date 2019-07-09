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

    // Hide page if login user has no authorization over the record
    public function preview($recordId = NULL, $context = NULL, $model){
        if($this->hasRelatedRecord($recordId, $model)){
            parent::preview($recordId, $context);
        }else{
            parent::preview();
        }
    }

    // Hide page if login user has no authorization over the record
    public function update($recordId = NULL, $context = NULL, $model){
        if($this->hasRelatedRecord($recordId, $model)){
            parent::update($recordId, $context);
        }else{
            parent::update();
        }
    }

    // Check if login user has authorizationn over the record
    private function hasRelatedRecord($recordId, $model){
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        $record = $model::whereIn('client_id',$clients)->find($recordId);
        return $record;
    }

    // Authorize login user to related records
    public function listExtendQuery($query, $definition = null) {
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        $query->whereIn('client_id', $clients);
    }

    public function onCheckClientSelector(){
        if(Session::has('activeClient')){
            return Client::with('config')->where('id',Session::get('activeClient'))->first();
        }
    }
}
