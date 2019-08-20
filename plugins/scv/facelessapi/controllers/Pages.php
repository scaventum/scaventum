<?php namespace scv\FacelessApi\Controllers;

use BackendMenu;
use Session;

use scv\FacelessApi\Controllers\FacelessAPIController;
use scv\FacelessApi\Models\Block;

class Pages extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.pages' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-pages', 'pages');
    }

    public function formExtendFields($form)
    {
        $page = $form->model;
        
        $blocks = [];

        if($page->client_id){
            $blocks = Block::where("client_id",$page->client_id)->orWhere("client_id",NULL)->orderBy('name', 'Asc')->get();
        }else if(Session::has('activeClient')){
            $page = Block::where("client_id",Session::get('activeClient'))->orWhere("client_id",NULL)->orderBy('name', 'Asc')->get();
        }

        if(!empty($blocks)){
            
            $groups = [];
            foreach($blocks as $block){
                $blockFields = $block->fields;
                $fields = [];

                usort($blockFields, function($a, $b) {
                    return $a['field']["field_tab"] <=> $b['field']["field_tab"];
                });

                foreach($blockFields as $blockField){

                    $field = $blockField["field"];

                    $field_type = $field["field_type"];
                    if(in_array($field["field_type"],["link","form"])){
                        $field_type = "dropdown";
                    }

                    $tab = (!empty($field["field_tab"])?$field["field_tab"]:"content");
                    $tab = ($tab == "content" ? e(trans("scv.facelessapi::lang.plugin.blocks.field_tab_content")) : e(trans("scv.facelessapi::lang.plugin.blocks.field_tab_settings")));

                    $main = [
                        "label" => $field["field_label"],
                        "placeholder" => $field["field_label"],
                        "comment" => $field["field_comment"],
                        "type" => $field_type,
                        "span" => (!empty($field["field_span"])?$field["field_span"]:"auto"),
                        "cssClass" => (!empty($field["field_css_class"])?$field["field_css_class"]:""),
                        "tab" => ucfirst($tab),
                    ];

                    $advanced = [];
                    if(isset($field["field_options"])){
                        $advanced["options"] = array_column($field["field_options"], 'value');
                    }

                    if($field["field_type"] == "link"){
                        $advanced["options"] = "getLinkOptions";
                    }

                    if($field["field_type"] == "colorpicker"){
                        $advanced["availableColors"] = [""];
                    }

                    $fields[$field["field_code"]] = array_merge($main,$advanced);

                    $fields = array_merge($fields,[
                        "block_code" => [
                            "label" => "scv.facelessapi::lang.plugin.blocks.code",
                            "placeholder" => "scv.facelessapi::lang.plugin.blocks.code",
                            "comment" => "scv.facelessapi::lang.plugin.blocks.code_description",
                            "span" => "left",
                            "readOnly" => true,
                            "required" => true,
                            "tab" => e(trans("scv.facelessapi::lang.plugin.blocks.field_tab_settings"))
                        ],
                        "block_purpose_code" => [
                            "label" => "scv.facelessapi::lang.plugin.templates.block_purpose_code",
                            "placeholder" => "scv.facelessapi::lang.plugin.templates.block_purpose_code",
                            "comment" => "scv.facelessapi::lang.plugin.templates.block_purpose_code_description",
                            "span" => "right",
                            "readOnly" => true,
                            "required" => true,
                            "tab" => e(trans("scv.facelessapi::lang.plugin.blocks.field_tab_settings"))
                        ]
                    ]);
                }
                
                $groups[$block->code] = [
                    "name" => $block->name,
                    "icon" => !empty($block->icon) ? $block->icon : "icon-align-justify",
                    "fields" => [
                        "blocks" => [
                            "type" => "nestedform",
                            "usePanelStyles" => false,
                            "form" => [
                                "secondaryTabs" => [
                                    "fields" => $fields
                                ]
                            ]
                        ]
                        
                    ]
                ];
            }

            $form->addTabFields([
                "blocks" => [
                    "label" => 'scv.facelessapi::lang.plugin.pages.blocks',
                    "tab" => 'scv.facelessapi::lang.plugin.pages.tab_content',
                    "span" => 'full',
                    "cssClass" => 'auto-collapse page-fields-blocks',
                    "type" => 'repeater',
                    "prompt" => 'scv.facelessapi::lang.plugin.custom_actions.add_new_item',
                    "comment" => 'scv.facelessapi::lang.plugin.pages.blocks_description',
                    "groups" => $groups,
                    "context" => ['update'],
                ]
            ]);
        }
    }
}
