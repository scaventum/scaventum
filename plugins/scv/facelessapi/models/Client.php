<?php namespace scv\FacelessApi\Models;

use Config as BackendConfig;
use BackendAuth;
use Session;
use ValidationException;
use Lang;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Config;
use scv\FacelessApi\Models\Theme;
use scv\FacelessApi\Models\ThemeCategory;
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
        'config' => ['scv\FacelessApi\Models\Config', 'delete' => true]
    ];

    /**
     * @var array List of has many relationships.
     */
    public $hasMany = [
        'themes' => ['scv\FacelessApi\Models\Theme'],
        'theme_categories' => ['scv\FacelessApi\Models\ThemeCategory']
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

    public function beforeDelete(){
        $delete = true;

        if($this->themes()->exists()){
            $delete = false;
        }
        if($this->theme_categories()->exists()){
            $delete = false;
        }

        if(!$delete){
            throw new ValidationException(['id' => Lang::get("scv.facelessapi::lang.plugin.validations.delete_error_record_exists")]);
        }
    }

    public static function toggleSessionActive($id, $active){
        if($active == 1){
            Session::put('activeClient', $id);
        }else{
            Session::forget('activeClient');
        }
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

    /**
     * @var array client objects related to login user.
     */
    public static function clientsByUser($user_id) {
        
        $clients = Client::whereHas('users', function($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return $clients;
    }

    /**
     * @var array client objects related to login user and selected client session.
     */
    public static function clientBySession($user_id) {
        
        if(Session::has('activeClient')){
            $clients = Client::where('id',Session::get('activeClient'))->get();
        }else{
            $clients = Client::clientsByUser($user_id);
        }

        return $clients;
    }
    
    /**
     * @var integer id of client if only has one user on create.
     */
    public static function getClientIdAttribute($values){
        if($values==NULL){
            $clients = Client::clientBySession(BackendAuth::getUser()->id);
    
            if(count($clients) === 1){
                return $clients[0]->id;
            }
        }else{
            return $values;
        }
    }

    /**
     * @var array id and name clients related to login user.
     */
    public static function getClientIdOptions(){
        $clients = Client::clientBySession(BackendAuth::getUser()->id)->pluck('name','id');
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

    /**
     * @var boolean if client is selected in session.
     */
    public function getSessionActiveAttribute(){
        $activeClient = Session::get('activeClient');

        if($activeClient == $this->id) return true;

        return false;
    }
}
