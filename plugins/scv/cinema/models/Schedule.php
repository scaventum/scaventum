<?php

namespace Scv\Cinema\Models;

use Model;

/**
 * Model
 */
class Schedule extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_cinema_schedules';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'movie' => ['Scv\Cinema\Models\Movie']
    ];
}
