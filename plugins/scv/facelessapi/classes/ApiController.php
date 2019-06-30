<?php namespace scv\FacelessApi\Classes;

use Request;
use Backend\Classes\Controller;

class ApiController extends Controller
{
    public $key;

    public function __construct(){
        parent::__construct();

        if(Request::method() == "POST"){
            if(Request::input("client_key")){
                $this->key = Request::input("client_key");
            }
        }
    }
}
