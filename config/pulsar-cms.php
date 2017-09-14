<?php

return [

    //******************************************************************************************************************
    //***   Type of editors
    //******************************************************************************************************************
    'editors'       => [
        (object)['id' => 1, 'name' => 'Wysiwyg'],
        (object)['id' => 2, 'name' => 'Contentbuilder'],
        (object)['id' => 3, 'name' => 'TextArea'],
    ],

    //******************************************************************************************************************
    //***   Status
    //******************************************************************************************************************
    'statuses'      => [
        (object)['id' => 1, 'name' => 'cms::pulsar.draft'],
        (object)['id' => 2, 'name' => 'cms::pulsar.publish']
    ]
];