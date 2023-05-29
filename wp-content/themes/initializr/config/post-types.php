<?php
return [
    /*
    'portfolio' => [
        'label'       => __('Portfolio', 'initializr'),
        'menu_icon'   => 'dashicons-portfolio',
        'supports'    => array('title', 'thumbnail', 'excerpt'),
        'has_archive' => true,
        'public'      => true,
        'taxonomies'  => ['portfolio-category'],
    ],*/
    'popups' => [
        'label'       => __('Popups', 'initializr'),
        'menu_icon'   => 'dashicons-admin-comments',
        'supports'    => array('title'),
        'has_archive' => true,
        'public'      => true,
        'publicly_queryable' => false,
        'taxonomies'  => ['portfolio-category'],
    ]
];
