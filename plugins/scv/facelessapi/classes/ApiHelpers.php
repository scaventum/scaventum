<?php namespace scv\FacelessApi\Classes;

use scv\FacelessApi\Models\Client;

class ApiHelpers
{
    public static function generateClientKey($length = 20){
        $client_key = str_random($length);

        $client = Client::where('key',$client_key)->first();
        if($client){
            $client_key = self::generateClientKey($length);
        }

        return $client_key;
    }
}
