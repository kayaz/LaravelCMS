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
        'typ',
        'slug',
        'updated_at',
        'menu',
        'uri',
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
