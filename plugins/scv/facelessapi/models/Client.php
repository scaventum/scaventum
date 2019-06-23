<?php namespace scv\FacelessApi\Models;

use scv\FacelessApi\Models\FacelessAPIModel;
/**
 * Model
 */
class Client extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Encryptable;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_clients';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'domain' => 'required|url',
        'key' => 'required|alpha_num|max:20'
    ];

    /**
     * @var array List of attributes to encrypt.
     */
    protected $encryptable = ['key'];

    /**
     * @var array List of belongs to many relationships.
     */
    public $belongsToMany = [
        'users' => ['Backend\Models\User', 'table' => 'scv_facelessapi_client_users']
    ];
}
