<?php namespace scv\FacelessApi\Models;

use Model;

/**
 * Model
 */
class ThemeValue extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_theme_values';

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'theme' => ['scv\FacelessApi\Models\Theme'],
        'theme_category' => ['scv\FacelessApi\Models\ThemeCategory'],
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
