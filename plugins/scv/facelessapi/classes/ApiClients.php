<?php namespace scv\FacelessApi\Classes;

use scv\FacelessApi\Classes\ApiController;
use scv\FacelessApi\Models\Client;

class ApiClients extends ApiController
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        
        if($this->key){
            return Client::where('key',$this->key)->where('active',1)->first();
        }
    }
}
