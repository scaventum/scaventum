<?php namespace scv\FacelessApi\Models;

use Model;

/**
 * Model
 */
class PageCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_page_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [];
      
}
