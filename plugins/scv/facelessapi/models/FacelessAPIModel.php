<?php namespace scv\FacelessApi\Models;

use Model;
use BackendAuth;

/**
 * Model
 */
class FacelessAPIModel extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public function beforeCreate(){
        $this->created_at = date("Y-m-d H:i:s");
        $this->created_by = BackendAuth::getUser()->id;
    }

    public function beforeSave(){
        $this->updated_at = date("Y-m-d H:i:s");
        $this->updated_by = BackendAuth::getUser()->id;
    }
}
