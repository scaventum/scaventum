<?php namespace scv\FacelessApi\Classes;

use Config;
use Response;

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
            if($theme){
                $currentThemeValues = [];
    
                $themeCategories = ThemeCategory::where('client_id',$this->client_id)->get();
                foreach($themeCategories as $themeCategory){
                    $themeValues = ThemeValue::where('theme_id',$theme->id)
                        ->where('theme_category_id',$themeCategory->id)
                        ->get();
                    foreach($themeValues as $themeValue){
                        $value = "";
    
                        if($themeValue->type == "text") $value = $themeValue->value_text;
                        elseif($themeValue->type == "number") $value = $themeValue->value_number;
                        elseif($themeValue->type == "color") $value = $themeValue->value_color;
                        elseif($themeValue->type == "media") $value = url(Config::get('cms.storage.media.path').$themeValue->value_media);
    
                        $currentThemeValues[$themeCategory->code][$themeValue->name] = $value;
                    }
                }

                return $currentThemeValues;
            }

            return Response::make( 'Active theme not found' , 404 );
        }
    }
}
