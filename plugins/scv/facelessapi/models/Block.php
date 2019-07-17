<?php namespace scv\FacelessApi\Models;

use Model;
use ValidationException;

use RainLab\Builder\Classes\ControlLibrary;

use scv\FacelessApi\Models\FacelessAPIModel;

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

    public function beforeSave(){

        // Cannot save if block without client relation exists
        $block = self::where('code',$this->code);
        if($this->id!==NULL){
            $block = $block->where('id','!=',$this->id);
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

        $remove = ['partial', 'hint','section','codeeditor','markdown','fileupload','recordfinder','relation'];

        $fieldTypes = array_diff_key($fieldTypes, array_flip($remove));

        return $fieldTypes;
    }
}
