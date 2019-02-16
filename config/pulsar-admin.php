<?php

return [

    //******************************************************************************************************************
    //***   Base lang, set main application language
    //******************************************************************************************************************
    'base_lang' => env('ADMIN_BASE_LANG', 'en'),

    //******************************************************************************************************************
    //***   Url to access to panel
    //******************************************************************************************************************
    'panel_url' => env('ADMIN_PANEL_URL', 'http://localhost:4200'),

    //******************************************************************************************************************
    //***   Resources that could contain custom fields
    //******************************************************************************************************************
    'field_group_resources' => [
        (object)['id' => 'cms-article-family',      'name' => 'Article families'],
        (object)['id' => 'market-product',          'name' => 'Products'],
        (object)['id' => 'hotels-hotel',            'name' => 'Hotels'],
        (object)['id' => 'spas-spa',                'name' => 'Spas'],
        (object)['id' => 'wineries-winery',         'name' => 'Wineries']
    ],

    //******************************************************************************************************************
    //***   Resources that could contain attachments
    //******************************************************************************************************************
    'attachment_resources' => [
        (object)['id' => 'cms-article',             'name' => 'Articles'],
        (object)['id' => 'market-product',          'name' => 'Products'],
        (object)['id' => 'hotels-hotel',            'name' => 'Hotels'],
        (object)['id' => 'crm-customer',            'name' => 'Customers'],
        (object)['id' => 'spas-spa',                'name' => 'Spas'],
        (object)['id' => 'wine-wine',               'name' => 'Wines'],
        (object)['id' => 'wine-winery',             'name' => 'Wineries'],
        (object)['id' => 'forem-group',             'name' => 'Groups'],
    ],

    //******************************************************************************************************************
    //***   Type fields to select on fields section
    //******************************************************************************************************************
    'field_types' => [
        (object)['id' => 'checkbox',            'name' => 'Checkbox',               'values' => false],
        (object)['id' => 'email',               'name' => 'Email',                  'values' => false],
        (object)['id' => 'model',               'name' => 'Model',                  'values' => false],
        (object)['id' => 'number',              'name' => 'Number',                 'values' => false],
        (object)['id' => 'select',              'name' => 'Select',                 'values' => true],
        (object)['id' => 'select-multiple',     'name' => 'Select multiple',        'values' => true],
        (object)['id' => 'text',                'name' => 'Text',                   'values' => false],
        (object)['id' => 'text-area',           'name' => 'Text Area',              'values' => false],
        (object)['id' => 'wysiwyg',             'name' => 'Wysiwyg',                'values' => false],
        (object)['id' => 'datetime-local',      'name' => 'Datetime local',         'values' => false],
    ],

    //******************************************************************************************************************
    //***   Type data to select on fields section
    //******************************************************************************************************************
    'data_types' => [
        (object)['id' => 1,      'name' => 'String',            'type' => 'string'],
        (object)['id' => 2,      'name' => 'Boolean',           'type' => 'boolean'],
        (object)['id' => 3,      'name' => 'Integer',           'type' => 'integer'],
        (object)['id' => 4,      'name' => 'Float',             'type' => 'float'],
        (object)['id' => 5,      'name' => 'Array',             'type' => 'array'],
        (object)['id' => 6,      'name' => 'Object',            'type' => 'object'],
    ],

    //******************************************************************************************************************
    //***  Sizes to create images for various screen sizes
    //******************************************************************************************************************
    'sizes' => [
        (object)['id' => '25',      'name' => '-25%'],
        (object)['id' => '50',      'name' => '-50%'],
        (object)['id' => '75',      'name' => '-75%'],
    ],

    //******************************************************************************************************************
    //***  Frequencies to execute report
    //******************************************************************************************************************
    'frequencies' => [
        (object)['id' => 1, 'name' => 'admin::pulsar.once'],
        (object)['id' => 2, 'name' => 'admin::pulsar.daily'],
        (object)['id' => 3, 'name' => 'admin::pulsar.weekly'],
        (object)['id' => 4, 'name' => 'admin::pulsar.monthly'],
        (object)['id' => 5, 'name' => 'admin::pulsar.quarterly'],
        (object)['id' => 6, 'name' => 'admin::pulsar.yearly']
    ],

    //******************************************************************************************************************
    //***  Extensions files
    //******************************************************************************************************************
    'extensions' => [
        (object)['id' => 'csv',     'name' => '.csv'],
        (object)['id' => 'xls',     'name' => '.xls'],
        (object)['id' => 'xlsx',    'name' => '.xlsx']
    ]
];