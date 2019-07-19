<?php namespace scv\FacelessApi\Controllers;

use BackendMenu;
use Session;

use scv\FacelessApi\Models\Client;
use scv\FacelessApi\Models\Theme;
use scv\FacelessApi\Models\ThemeCategory;
use scv\FacelessApi\Controllers\FacelessAPIController;

class Themes extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.themes' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-global', 'themes');
        $this->addJs("/plugins/scv/facelessapi/assets/js/theme.js", "1.0.0");
    }

    public function formExtendFields($form)
    {
        $theme = $form->model;

        $themeCategories = ThemeCategory::where("client_id",$theme->client_id)->get();
        $context[] = "update";

        if(Session::has('activeClient')){
            $themeCategories = ThemeCategory::where("client_id",Session::get('activeClient'))->get();
            $context[] = "create";
        }

        if(count($themeCategories)>0){
            foreach($themeCategories as $themeCategory){
                $form->addTabFields([
                    "custom_theme_values[".$themeCategory->id."]" => [
                        "type" => "repeater",
                        "context" => $context,
                        "label" => "scv.facelessapi::lang.plugin.theme_values.theme_values",
                        "tab" => $themeCategory->name,
                        "prompt" => "scv.facelessapi::lang.plugin.custom_actions.add_new_item",
                        "form" => [
                            "fields" => [
                                "name" => [
                                    "type" => "text",
                                    "label" => "scv.facelessapi::lang.plugin.theme_values.name",
                                    "placeholder" => "scv.facelessapi::lang.plugin.theme_values.name",
                                    "comment" => "scv.facelessapi::lang.plugin.theme_values.name_description",
                                    "span" => "storm",
                                    "cssClass" => "col-md-4",
                                    "required" => true
                                ],
                                "type" => [
                                    "type" => "dropdown",
                                    "label" => "scv.facelessapi::lang.plugin.theme_values.type",
                                    "placeholder" => "scv.facelessapi::lang.plugin.theme_values.type",
                                    "comment" => "scv.facelessapi::lang.plugin.theme_values.type_description",
                                    "span" => "storm",
                                    "cssClass" => "col-md-4",
                                    "default" => "color",
                                    "options" => [
                                        "text" => "scv.facelessapi::lang.plugin.theme_values.value_text",
                                        "number" => "scv.facelessapi::lang.plugin.theme_values.value_number",
                                        "color" => "scv.facelessapi::lang.plugin.theme_values.value_color",
                                        "media" => "scv.facelessapi::lang.plugin.theme_values.value_media"
                                    ]
                                ],
                                "value_text" => [
                                    "type" => "text",
                                    "label" => "scv.facelessapi::lang.plugin.theme_values.value_text",
                                    "placeholder" => "scv.facelessapi::lang.plugin.theme_values.value_text",
                                    "comment" => "scv.facelessapi::lang.plugin.theme_values.value_text_description",
                                    "span" => "storm",
                                    "cssClass" => "col-md-4",
                                    "trigger" => [
                                        "action" => "show",
                                        "field" => "type",
                                        "condition" => "value[text]"
                                    ]
                                ],
                                "value_number" => [
                                    "type" => "number",
                                    "label" => "scv.facelessapi::lang.plugin.theme_values.value_number",
                                    "placeholder" => "scv.facelessapi::lang.plugin.theme_values.value_number",
                                    "comment" => "scv.facelessapi::lang.plugin.theme_values.value_number_description",
                                    "span" => "storm",
                                    "cssClass" => "col-md-4",
                                    "trigger" => [
                                        "action" => "show",
                                        "field" => "type",
                                        "condition" => "value[number]"
                                    ]
                                ],
                                "value_color" => [
                                    "type" => "colorpicker",
                                    "label" => "scv.facelessapi::lang.plugin.theme_values.value_color",
                                    "comment" => "scv.facelessapi::lang.plugin.theme_values.value_color_description",
                                    "span" => "storm",
                                    "cssClass" => "col-md-4",
                                    "availableColors" => [""],
                                    "trigger" => [
                                        "action" => "show",
                                        "field" => "type",
                                        "condition" => "value[color]"
                                    ]
                                ],
                                "value_media" => [
                                    "type" => "mediafinder",
                                    "label" => "scv.facelessapi::lang.plugin.theme_values.value_media",
                                    "span" => "storm",
                                    "cssClass" => "col-md-4",
                                    "comment" => "scv.facelessapi::lang.plugin.theme_values.value_media_description",
                                    "trigger" => [
                                        "action" => "show",
                                        "field" => "type",
                                        "condition" => "value[media]"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
            }
        }else{
            $form->addFields([
                "_no_theme_categories" => [
                    "type" => "partial",
                    "path" => "$/scv/facelessapi/partials/_theme_fields_no_theme_categories.htm",
                    "context" => [
                        "update"
                    ]
                ]
            ]);
        }
    }

    public function onToggleActive(){
        $id = intval(post('id'));
        $active = intval(post('active'));

        Theme::toggleActive($id, $active);

        return $this->listRefresh();
    }
}
