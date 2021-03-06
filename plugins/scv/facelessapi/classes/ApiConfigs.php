<?php namespace scv\FacelessApi\Classes;

use scv\FacelessApi\Classes\ApiController;
use scv\FacelessApi\Models\Client;

class ApiConfigs extends ApiController
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        
        if($this->client_id){
            $client = Client::find($this->client_id)->where('active',1)->first();
            return $client->config;
        }
    }
}
