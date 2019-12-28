<?php

return [
    'parent'        => 'id_parent',
    'primary_key'   => 'id',
    'generate_url'  => true,
    'childNode'     => 'child',
    'body' => [
        'id',
        'nazwa',
        'slug',
    ],
    'html' => [
        'label'     => 'nazwa',
        'href'      => 'uri'
    ],
    'dropdown' => [
        'prefix'    => '',
        'label'     => 'nazwa',
        'value'     => 'id'
    ]
];
