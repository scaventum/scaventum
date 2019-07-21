<?php namespace scv\FacelessApi\Models;

use Model;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;

/**
 * Model
 */
class Template extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_templates';

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client']
    ];
    /**
     * @var array Jsonable fields
     */
    public $jsonable = ["blocks"];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public function filterFields($fields, $context = null)
    {
        if(isset($fields->client_id)){
            if(count($this->getClientIdOptions()) <= 1){
                $fields->client_id->readOnly = true;
            }

            if ($context == 'update') {
                $fields->client_id->readOnly = true;
            }
        }
    }

    /**
     * @var integer id of client if only has one user on create.
     */
    public function getClientIdAttribute($values){
        if($values==NULL){
            $client_id = Client::getClientIdAttribute($values);
    
            return  $client_id;
            
        }else{
            return $values;
        }
    }

    /**
     * @var array clients related to login user.
     */
    public function getClientIdOptions(){
        $clients = Client::getClientIdOptions();
        return $clients;
    }
}
