<?php namespace scv\FacelessApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend;

use scv\FacelessApi\Models\Client;
use scv\FacelessApi\Models\Config;
use scv\FacelessApi\Classes\ApiHelpers;

class FacelessAPIController extends Controller
{
    // Redirect if login user has no authorization over the record
    public function preview($recordId = NULL, $context = NULL, $model){
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        $record = $model::whereIn('client_id',$clients)->find($recordId);
        if($record){
            parent::preview($recordId, $context);
        }else{
            parent::preview();
        }
    }

    // Redirect if login user has no authorization over the record
    public function update($recordId = NULL, $context = NULL, $model){
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        $record = $model::whereIn('client_id',$clients)->find($recordId);
        if($record){
            parent::update($recordId, $context);
        }else{
            parent::update();
        }
    }

    // Authorize login user to related records
    public function listExtendQuery($query, $definition = null) {
        $clients = array_keys(Client::getClientIdOptions()->toArray());
        $query->whereIn('client_id', $clients);
    }
}
