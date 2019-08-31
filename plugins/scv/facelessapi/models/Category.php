<?php namespace scv\FacelessApi\Models;

use Model;
use ValidationException;
use Lang;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;

/**
 * Model
 */
class Category extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        "name" => "required",
        "code" => "required",
    ];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client'],
    ];

    /**
     * @var array List of has many relationships.
     */
    public $hasMany = [
        'pages' => ['scv\FacelessApi\Models\Page']
    ];

    public function filterFields($fields, $context = null)
    {
        if(count($this->getClientIdOptions()) <= 1){
            $fields->client_id->readOnly = true;
        }

        if ($context == 'update') {
            $fields->client_id->readOnly = true;
        }
    }

    public function beforeSave(){
        $category = self::where('name',$this->name)->where('client_id',$this->client_id);

        if($this->id!==NULL){
            $category = $category->where('id','!=',$this->id);
        }

        $category = $category->first();

        if($category){
            throw new ValidationException(['name' => Lang::get("scv.facelessapi::lang.plugin.categories.validation.duplicate")]);
        }else{
            parent::beforeSave();
        }
    }

    public function beforeDelete(){
        $delete = true;

        if($this->pages()->exists()){
            $delete = false;
        }

        if(!$delete){
            throw new ValidationException(['id' => Lang::get("scv.facelessapi::lang.plugin.validations.delete_error_record_exists")]);
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
