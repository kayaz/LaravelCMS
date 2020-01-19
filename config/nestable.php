<?php

return [
    'parent'        => 'parent_id',
    'primary_key'   => 'id',
    'generate_url'  => true,
    'childNode'     => 'child',
    'body' => [
        'id',
        'title',
        'slug',
        'typ',
        'updated_at',
        'menu',
        'uri',
    ],
    'html' => [
        'label'     => 'title',
        'href'      => 'uri'
    ],
    'dropdown' => [
        'prefix'    => '',
        'label'     => 'title',
        'value'     => 'id'
    ]
];
