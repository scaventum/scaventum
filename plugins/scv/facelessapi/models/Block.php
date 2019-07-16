<?php namespace scv\FacelessApi\Models;

use Model;

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
    ];

    /**
     * @var array Jsonable fields
     */
    public $jsonable = [
        'fields'
    ];

    
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
