<?php namespace scv\FacelessApi\Classes;

use scv\FacelessApi\Classes\ApiController;
use scv\FacelessApi\Models\Theme;
use scv\FacelessApi\Models\ThemeCategory;
use scv\FacelessApi\Models\ThemeValue;

class ApiThemes extends ApiController
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        
        if($this->client_id){
            $theme = Theme::where('client_id',$this->client_id)->where('active',1)->first();
            $currentThemeValues = [];

            $themeCategories = ThemeCategory::where('client_id',$this->client_id)->get();
            foreach($themeCategories as $themeCategory){
                $themeValues = ThemeValue::where('theme_id',$theme->id)
                    ->where('theme_category_id',$themeCategory->id)
                    ->get();
                foreach($themeValues as $themeValue){
                    $currentThemeValues[$themeCategory->code][] = [
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
    }
}
