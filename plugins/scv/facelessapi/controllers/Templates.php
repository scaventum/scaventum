<?php namespace scv\FacelessApi\Controllers;

use BackendMenu;
use Session;

use scv\FacelessApi\Controllers\FacelessAPIController;
use scv\FacelessApi\Models\Block;


class Templates extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.templates' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-pages', 'templates');
    }

    public function formExtendFields($form)
    {
        $template = $form->model;

        $blocks = [];

        if(Session::has('activeClient')){
            $blocks = Block::where("client_id",Session::get('activeClient'))->orWhere("client_id",NULL)->orderBy('name', 'Asc')->get();
        }else if($template->client_id){
            $blocks = Block::where("client_id",$template->client_id)->orWhere("client_id",NULL)->orderBy('name', 'ASc')->get();
        }

        if(!empty($blocks)){
            
            $groups = [];
            foreach($blocks as $block){
                $groups[$block->code] = [
                    "name" => $block->name,
                    "fields" => [
                        "block_purpose" => [
                            "label" => "Block Purpose",
                            "span" => "storm",
                            "cssClass" => "col-md-4",
                            "required" => true
                        ],
                        "block_purpose_code" => [
                            "label" => "Block Purpose Code",
                            "span" => "storm",
                            "cssClass" => "col-md-4",
                            "readOnly" => true,
                            "preset" =>[
                                "type" => "slug",
                                "field" => "block_purpose"
                            ],
                            "required" => true
                        ],
                        "block_code" => [
                            "label" => "Block Code",
                            "span" => "storm",
                            "cssClass" => "col-md-4",
                            "readOnly" => true,
                            "default" => $block->code
                        ],
                    ]
                ];
            }

            $form->addFields([
                "blocks" => [
                    "label" => 'scv.facelessapi::lang.plugin.templates.blocks',
                    "span" => 'storm',
                    "cssClass" => 'col-md-12 auto-collapse',
                    "type" => 'repeater',
                    "prompt" => 'scv.facelessapi::lang.plugin.custom_actions.add_new_item',
                    "comment" => 'scv.facelessapi::lang.plugin.templates.blocks_description',
                    "groups" => $groups
                ]
            ]);
        }
    }
}
