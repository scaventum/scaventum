<?php return [
    'plugin' => [
        'name' => 'Faceless API',
        'name_admin' => 'API Admin',
        'name_global' => 'API Global',
        'description' => 'Faceless API is an OctoberCMS plugin which enable publisher to edit the content for remote front-end',
        'custom_actions' => [
            'add_new_item' => 'Add New Item',
        ],
        'settings' => [
            'label' => [
                'manage_clients' => 'Manage Faceless API Clients',
                'manage_configs' => 'Manage Faceless API Configs',
                'manage_themes' => 'Manage Faceless API Themes',
                'manage_theme_categories' => 'Manage Faceless API Theme Categories',
            ]
        ],
        'clients' => [
            'clients' => 'Clients',
            'active' => 'Active',
            'active_description' => 'Activity status of the client front end website',
            'active_on' => 'Yes',
            'active_off' => 'No',
            'name' => 'Client Name',
            'name_description' => 'A friendly client name',
            'domain' => 'Client Domain',
            'domain_description' => 'Domain of client front end website',
            'description' => 'Client Description',
            'description_description' => 'Brief information about client website',
            'key' => 'Client Key',
            'key_description' => 'API key to authorize client front end website HTTP requests',
            'key_copy' => 'Copy Client Key',
            'key_generate' => 'Generate New Client Key',
        ],
        'configs' => [
            'configs' => 'Configuration',
            'site_name' => 'Site Name',
            'site_name_description' => 'Name of the website',
            'site_address' => 'Site Address',
            'site_address_description' => 'Address of the website',
            'site_description' => 'Site Desription',
            'site_description_description' => 'Brief information of the website',
            'online' => 'Online',
            'online_description' => 'Website online status',
            'site_locale' => 'Site Locale',
            'site_locale_description' => 'Main language og the website',
            'site_timezone' => 'Site Timezone',
            'site_timezone_description' => 'Local timezone for the website',
        ],
        'themes' => [
            'themes' => 'Themes',
            'name' => 'Theme Name',
            'name_description' => 'Theme name',
            'description' => 'Theme Descrption',
            'description_description' => 'Brief theme information',
            'client_id' => 'Client',
            'client_id_description' => 'Related client',
            'active' => 'Active',
            'active_description' => 'Activating this theme will deactivate other themes',
        ],
        'theme_categories' => [
            'theme_categories' => 'Theme Categories',
            'name' => 'Category Name',
            'name_description' => 'Category name of theme',
            'code' => 'Category Code',
            'code_description' => 'Category code for readability purpose',
            'validation' => [
                'duplicate' => 'Category name has been used by client'
            ],
        ],
        'theme_values' => [
            'theme_values' => 'Theme Values',
            'name' => 'Value Name',
            'name_description' => 'Name of theme value',
            'type' => 'Type',
            'type_description' => 'Type of theme value',
            'value_text' => 'Text',
            'value_text_description' => 'Free text',
            'value_number' => 'Number',
            'value_number_description' => 'Numeric value',
            'value_color' => 'Color',
            'value_color_description' => 'Hexadecimal color value',
            'value_media' => 'Media',
            'value_media_description' => 'Media finder',
            'validation' => [
                'name_required' => 'Value name is required',
                'name_alpha_dash' => 'Name must contain either alphabetic, numeric, _ or - without space',
                'type_required' => 'Value type is required'
            ],
        ]
    ]
];