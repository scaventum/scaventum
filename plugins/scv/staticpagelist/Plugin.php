<?php namespace scv\StaticPageList;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            '\Scv\StaticPageList\Components\StaticPageList' => 'staticPageList',
        ];
    }

    public function registerSettings()
    {
    }
}
