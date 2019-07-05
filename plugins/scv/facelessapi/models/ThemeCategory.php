<?php namespace scv\FacelessApi\Models;

use Model;
use ValidationException;
use Lang;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;

/**
 * Model
 */
class ThemeCategory extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_theme_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client', 'table' => 'scv_facelessapi_clients'],
        'theme' => ['scv\FacelessApi\Models\Theme', 'table' => 'scv_facelessapi_themes']
    ];

    public function beforeSave(){
        $themecategory = self::where('name',$this->name)->where('client_id',$this->client_id);

        if($this->id!==NULL){
            $themecategory = $themecategory->where('id','!=',$this->id);
        }

        $themecategory = $themecategory->first();

        if($themecategory){
            throw new ValidationException(['name' => Lang::get("scv.facelessapi::lang.plugin.themecategories.validation.duplicate")]);
        }else{
            parent::beforeSave();
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
