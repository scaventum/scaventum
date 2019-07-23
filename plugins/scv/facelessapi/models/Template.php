<?php namespace scv\FacelessApi\Models;

use Model;
use ValidationException;

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
        "name" => "required",
        "code" => "required",
        "client_id" => "required",
        'blocks.*.block_purpose_code' => 'required|alpha_dash',
        'blocks.*.block_purpose' => 'required',
        'blocks.*.block_code' => 'required',
    ];

    /**
     * @var array Validation messages.
     */
    public $customMessages = [
        'blocks.*.block_purpose_code.required' => 'scv.facelessapi::lang.plugin.templates.validation.block_purpose_code_required',
        'blocks.*.block_purpose_code.alpha_dash' => 'scv.facelessapi::lang.plugin.templates.validation.block_purpose_code_alpha_dash',
        'blocks.*.block_purpose.required' => 'scv.facelessapi::lang.plugin.templates.validation.block_purpose_required',
        'blocks.*.block_code.required' => 'scv.facelessapi::lang.plugin.templates.validation.block_code_required',
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

    public function beforeSave(){
        // Cannot save if block code exists
        $template = self::where('code',$this->code)->where('client_id',$this->client_id);
        if($this->id!==NULL){
            $template = $template->where('id','!=',$this->id);
        }
        $template = $template->first();

        if($template){
            throw new ValidationException(['code' => e(trans("scv.facelessapi::lang.plugin.templates.validation.duplicate"))]);
        }
        
        // Cannot save if there is duplication of field code 
        $blocks = false;
        $blockPurposeCodeArray = [];
        foreach($this->blocks as $block){
            if(in_array($block["block_purpose_code"], $blockPurposeCodeArray)){
                $blocks = true;
                break;
            }else{
                $blockPurposeCodeArray[] = $block["block_purpose_code"];
            }
        }

        if($blocks){
            throw new ValidationException(['blocks' => e(trans("scv.facelessapi::lang.plugin.templates.validation.duplicate_block_purpose"))]);
        }

        parent::beforeSave();
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
