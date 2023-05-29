<?php

return [
    'env'           => 'adaptable',
    'nav-menus'     => ['header'],
    'widget-areas'  => [
        'sidebar' => array(
            'name' => __('Page sidebar', 'initializr'),    // Display name
            'class' => 'sidebar',
        ),
        'footer',
    ],
    'logo'          => [
        'width'  => 161,
        'height' => 68
    ],
    'excerpt'       => '...',
    'partial-dir'   => get_template_directory() . '/partials',
    'shortcode-dir' => get_template_directory() . '/partials/shortcodes',
    'asset-uri'     => get_template_directory_uri() . '/assets',
    'google-maps-api-key' => '',
    'template-folder'   => 'page-templates/',
    'asset-version'     => '1.0',
];
