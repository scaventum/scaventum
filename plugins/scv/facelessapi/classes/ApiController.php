<?php namespace scv\FacelessApi\Classes;

use Request;
use Backend\Classes\Controller;

use Scv\FacelessApi\Models\Client;

class ApiController extends Controller
{
    public $key;

    public $client_id;

    public function __construct(){
        parent::__construct();

        if(Request::method() == "POST"){
            if(Request::input("client_key")){
                $this->key = Request::input("client_key");

                $client = Client::where('key',$this->key)->where('active',1)->first();
                $this->client_id = $client->id;
            }
        }
    }
}
