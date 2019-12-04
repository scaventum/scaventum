<?php

namespace scv\FacelessApi\Models;

use Model;
use BackendAuth;
use ValidationException;
use Lang;
use Flash;

use scv\FacelessApi\Models\FacelessAPIModel;
use scv\FacelessApi\Models\Client;
use scv\FacelessApi\Models\ThemeValue;
use scv\FacelessApi\Models\ThemeCategory;

/**
 * Model
 */
class Theme extends FacelessAPIModel
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Purgeable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'scv_facelessapi_themes';

    /**
     * @var array Validation rules.
     */
    public $rules = [
        'name' => 'required',
        'client_id' => 'required',
        'custom_theme_values.*.*.name' => 'required|alpha_dash',
        'custom_theme_values.*.*.type' => 'required'
    ];

    /**
     * @var array Validation messages.
     */
    public $customMessages = [
        'custom_theme_values.*.*.name.required' => 'scv.facelessapi::lang.plugin.theme_values.validation.name_required',
        'custom_theme_values.*.*.name.alpha_dash' => 'scv.facelessapi::lang.plugin.theme_values.validation.name_alpha_dash',
        'custom_theme_values.*.*.type.required' => 'scv.facelessapi::lang.plugin.theme_values.validation.type_required'
    ];

    /**
     * @var array List of fillable fields.
     */
    public $fillable  = ['active'];

    /**
     * @var array List of belongs to relationships.
     */
    public $belongsTo = [
        'client' => ['scv\FacelessApi\Models\Client']
    ];

    /**
     * @var array List of has many relationships.
     */
    public $hasMany = [
        'theme_values' => ['scv\FacelessApi\Models\ThemeValue']
    ];


    /**
     * @var array List of purgeable fields.
     */
    public $purgeable = [
        "custom_theme_values"
    ];

    public function filterFields($fields, $context = null)
    {
        if (count($this->getClientIdOptions()) <= 1) {
            if (isset($fields->client_id)) {
                $fields->client_id->readOnly = true;
            }
        }

        if ($context == 'update') {
            $fields->client_id->readOnly = true;
        }
    }

    public function beforeCreate()
    {
        parent::beforeCreate();
        $this->active = 0;
    }

    public function afterSave()
    {
        if (post("Theme[custom_theme_values]")) {
            $this->theme_values()->delete();

            $newThemeValues = [];
            foreach (post("Theme[custom_theme_values]") as $themeCategoryKey => $themeCategory) {
                foreach ($themeCategory as $themeValue) {
                    $newThemeValues[] = [
                        "name" => $themeValue["name"],
                        "theme_id" => $this->id,
                        "theme_category_id" => $themeCategoryKey,
                        "type" => $themeValue["type"],
                        "value_text" => $themeValue["value_text"],
                        "value_number" => is_numeric($themeValue["value_number"]) ? $themeValue["value_number"] : 0,
                        "value_color" => $themeValue["value_color"],
                        "value_media" => $themeValue["value_media"],
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s"),
                        "created_by" => BackendAuth::getUser()->id,
                        "updated_by" => BackendAuth::getUser()->id,
                    ];
                }
            }

            ThemeValue::insert($newThemeValues);
        }
    }

    public function beforeDelete()
    {
        $delete = true;

        if ($this->theme_values()->exists()) {
            $delete = false;
        }

        if (!$delete) {
            throw new ValidationException(['id' => Lang::get("scv.facelessapi::lang.plugin.validations.delete_error_record_exists")]);
        }
    }

    /**
     * @var integer id of client if only has one user on create.
     */
    public function getClientIdAttribute($values)
    {
        if ($values == NULL) {
            $client_id = Client::getClientIdAttribute($values);

            return  $client_id;
        } else {
            return $values;
        }
    }

    /**
     * @var array clients related to login user.
     */
    public function getClientIdOptions()
    {
        $clients = Client::getClientIdOptions();
        return $clients;
    }

    /**
     * @var array values related to theme.
     */
    public function getCustomThemeValuesAttribute()
    {
        $currentThemeValues = [];

        $themeCategories = ThemeCategory::where('client_id', $this->client_id)->get();
        foreach ($themeCategories as $themeCategory) {
            $themeValues = ThemeValue::where('theme_id', $this->id)
                ->where('theme_category_id', $themeCategory->id)
                ->get();
            foreach ($themeValues as $themeValue) {
                $currentThemeValues[$themeCategory->id][] = [
                    "name" => $themeValue->name,
                    "type" => $themeValue->type,
                    "value_text" => $themeValue->value_text,
                    "value_number" => $themeValue->value_number,
                    "value_color" => $themeValue->value_color,
                    "value_media" => $themeValue->value_media,
                ];
            }
        }

        return $currentThemeValues;
    }

    public static function toggleActive($id, $active)
    {
        $client_id = Theme::find($id)->client_id;

        if ($client_id != NULL) {
            if ($active) {
                Theme::where('client_id', $client_id)->update([
                    "active" => 0,
                ]);
            }

            Theme::find($id)->update(["active" => $active]);
            Flash::success(e(trans('scv.facelessapi::lang.plugin.themes.theme_toggle_on')));
        }
    }
}
