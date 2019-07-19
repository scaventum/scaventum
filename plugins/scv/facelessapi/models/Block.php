<?php namespace scv\FacelessApi\Models;

use Model;
use ValidationException;

use RainLab\Builder\Classes\ControlLibrary;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;

/**
 * Model
 */
class Block extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_blocks';

    /**
     * @var array Validation rules
     */
    public $rules = [
        "name" => "required",
        "code" => "required",
        'fields.*.field.field_code' => 'required|alpha_dash',
        'fields.*.field.field_label' => 'required',
        'fields.*.field.field_type' => 'required',
    ];

    /**
     * @var array Validation messages.
     */
    public $customMessages = [
        'fields.*.field.field_code.required' => 'scv.facelessapi::lang.plugin.blocks.validation.field_code_required',
        'fields.*.field.field_code.alpha_dash' => 'scv.facelessapi::lang.plugin.blocks.validation.field_code_alpha_dash',
        'fields.*.field.field_label.required' => 'scv.facelessapi::lang.plugin.blocks.validation.field_label_required',
        'fields.*.field.field_type.required' => 'scv.facelessapi::lang.plugin.blocks.validation.field_type_required'
    ];

    /**
     * @var array Jsonable fields
     */
    public $jsonable = [
        'fields'
    ];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client']
    ];

    public function filterFields($fields, $context = null)
    {
        if(isset($fields->client_id)){
            if ($context == 'update') {
                $fields->client_id->readOnly = true;
            }
            $fields->name->span = 'storm';
            $fields->name->cssClass = 'col-md-4';
            $fields->code->span = 'storm';
            $fields->code->cssClass = 'col-md-4';
            $fields->fields->span = 'storm';
            $fields->fields->cssClass = 'col-md-12 auto-collapse';
        }
    }

    public function beforeSave(){

        // Cannot save if block code exists
        $block = self::where('code',$this->code);
        if($this->id!==NULL){
            $block = $block->where('id','!=',$this->id);
        }
        if(post('Block[client_id]')){
            $block = $block->where('client_id',$this->client_id);
        }else{
            $block = $block->where('client_id',NULL);
        }
        $block = $block->first();

        if($block){
            throw new ValidationException(['name' => e(trans("scv.facelessapi::lang.plugin.blocks.validation.duplicate"))]);
        }
        
        // Cannot save if there is duplication of field code 
        $fields = false;
        $fieldCodeArray = [];
        foreach($this->fields as $field){
            if(in_array($field["field"]["field_label"], $fieldCodeArray)){
                $fields = true;
                break;
            }else{
                $fieldCodeArray[] = $field["field"]["field_label"];
            }
        }

        if($fields){
            throw new ValidationException(['name' => e(trans("scv.facelessapi::lang.plugin.blocks.validation.duplicate_field_code"))]);
        }

        parent::beforeSave();
    }

    
    public function getFieldTypeList($group = NULL){
        $library = ControlLibrary::instance();
        $controls = $library->listControls();

        if($group != NULL){
            return $controls[$group];
        }else{
            return array_merge($controls["Standard"],$controls["Widgets"]);
        }
    }

    public function getFieldTypeOptions(){
        $rawFieldTypes = self::getFieldTypeList();
        $fieldTypes = array_filter(array_combine(array_keys($rawFieldTypes), array_column($rawFieldTypes, 'name')));

        $removedFieldTypes = ['partial', 'hint','section','codeeditor','markdown','fileupload','recordfinder','relation'];
        $customFieldTypes = [
            'link' => 'scv.facelessapi::lang.plugin.blocks.field_type_link', 
            'form' => 'scv.facelessapi::lang.plugin.blocks.field_type_form'
        ];

        $fieldTypes = array_diff_key($fieldTypes, array_flip($removedFieldTypes));
        $fieldTypes = array_merge($fieldTypes,$customFieldTypes);

        return $fieldTypes;
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
