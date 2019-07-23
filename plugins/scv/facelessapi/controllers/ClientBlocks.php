<?php namespace scv\FacelessApi\Controllers;

use BackendMenu;

use scv\FacelessApi\Controllers\FacelessAPIController;
use scv\FacelessApi\Models\Block;

class ClientBlocks extends FacelessAPIController
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'scv.facelessapi.client_blocks' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('scv.FacelessApi', 'faceless-api-pages', 'client-blocks');
        $this->addCss("/plugins/scv/facelessapi/assets/css/style.css", "1.0.0");
        $this->addJs("/plugins/scv/facelessapi/assets/js/clients.js", "1.0.0");
    }

    public function formExtendFields($form, $fields)
    {
        $fieldFields = $form->getField('fields');
        $form->removeField('fields');

        $form->addFields([
            "client_id" => [
                "label" => 'scv.facelessapi::lang.plugin.themes.client_id',
                "showSearch" => true,
                "span" => 'storm',
                "cssClass" => 'col-md-6',
                "placeholder" => 'scv.facelessapi::lang.plugin.themes.client_id',
                "required" => true,
                "type" => 'dropdown',
                "comment" => 'scv.facelessapi::lang.plugin.themes.client_id_description'
            ],
            'fields' => $fieldFields->config,
        ]);
    }

    public function listExtendColumns($list)
    {
        $list->addColumns([
            "client[name]" => [
                "label" => 'scv.facelessapi::lang.plugin.clients.name',
                "type" => "text",
                "searchable" => true,
                "sortable" => true
            ]
        ]);
    }
}
