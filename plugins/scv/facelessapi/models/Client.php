<?php namespace scv\FacelessApi\Models;

use Config as BackendConfig;
use BackendAuth;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Config;
use scv\FacelessApi\Classes\ApiHelpers;
/**
 * Model
 */
class Client extends FacelessAPIModel
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_clients';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'key' => 'required|alpha_num|max:20|unique:scv_facelessapi_clients'
    ];

    /**
     * @var array List of belongs to many relationships.
     */
    public $belongsToMany = [
        'users' => ['Backend\Models\User', 'table' => 'scv_facelessapi_client_users']
    ];

    /**
     * @var array List of has one relationships.
     */
    public $hasOne = [
        'config' => ['scv\FacelessApi\Models\Config', 'table' => 'scv_facelessapi_configs', 'delete' => true]
    ];

    /**
     * @var array List of has many relationships.
     */
    public $hasMany = [
        'themes' => ['scv\FacelessApi\Models\Theme', 'table' => 'scv_facelessapi_themes'],
        'themecategories' => ['scv\FacelessApi\Models\ThemeCategory', 'table' => 'scv_facelessapi_theme_categories']
    ];

    public function afterCreate(){
        $config = new Config();
        $config->client_id = $this->id;
        $config->online = 0;
        $config->site_name = "New Site";
        $config->site_address = "";
        $config->site_description = "";
        $config->site_locale = BackendConfig::get("app.locale");
        $config->site_timezone = BackendConfig::get("app.timezone");
        $config->updated_by = BackendAuth::getUser()->id;
        $config->created_by = BackendAuth::getUser()->id;
        $config->save();
    }

    /**
     * @var string site address from config.
     */
    public function getDomainAttribute(){
        if($this->config){
            return $this->config->site_address;
        }

        return "";
    }

    public static function clientsByUser($user_id) {
        $clients = Client::whereHas('users', function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return $clients;
    }
    
    /**
     * @var integer id of client if only has one user on create.
     */
    public static function getClientIdAttribute($values){
        if($values==NULL){
            $clients = Client::clientsByUser(BackendAuth::getUser()->id);
    
            if(count($clients) === 1){
                return $clients[0]->id;
            }
        }else{
            return $values;
        }
    }

    /**
     * @var array clients related to login user.
     */
    public static function getClientIdOptions(){
        $clients = Client::clientsByUser(BackendAuth::getUser()->id)->pluck('name','id');
        return $clients;
    }

    /**
     * @var array clients related to login user.
     */
    public static function clientByUserArray(){
        $clients = Client::getClientIdOptions()->toArray();
        return $clients;
    }

     /**
     * @var integer id of client if only has one user on create.
     */
    public function getKeyAttribute($values){
        if($values==NULL){
            return ApiHelpers::generateClientKey(20);
            
        }else{
            return $values;
        }
    }
}
