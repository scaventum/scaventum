<?php

namespace Scv\Cinema\Models;

use Model;
use BackendAuth;
use October\Rain\Database\Traits\Sortable;

/**
 * Model
 */
class Movie extends Model
{
    use \October\Rain\Database\Traits\Validation;

    use \October\Rain\Database\Traits\SoftDelete;

    use \October\Rain\Database\Traits\Revisionable;

    use Sortable;

    protected $dates = ['deleted_at'];

    /**
     * @var array Monitor these attributes for changes.
     */
    protected $revisionable = ['title', 'description', 'release_date'];

    const SORT_ORDER = 'sort_order';
    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_cinema_movies';

    /**
     * @var array Relations
     */
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [];

    /**
     * @var array List of belongs to relationships.
     */
    public $hasMany = [
        'schedules' => ['Scv\Cinema\Models\Schedule']
    ];

    public function diff()
    {
        $history = $this->revision_history;
    }


    public function getRevisionableUser()
    {
        return BackendAuth::getUser()->id;
    }
}
