<?php

return [
    'styles'   => [
        'styles' => [
            'src' => '/assets/css/styles.css'
        ],
        'owl' => [
            'src' => '/assets/3rdparty/owl-carousel/owl.carousel.css',
            'enqueue' => false,
        ],
        'slick' => [
            'src' => '/assets/3rdparty/slick/slick.css',
            'enqueue' => false,
        ],
        'fontawesome-5-pro' => [
            'src' => '/assets/fonts/fontawesome-pro-5.10.1-web/css/all.min.css',
        ],
        'icomoon' => [
            'src' => '/assets/fonts/icomoon/style.css'
        ],
        'bootstrap' => [
            'src' => '/assets/3rdparty/bootstrap/css/bootstrap.css'
        ],
    ],
    'scripts'  => [
        'lozad'        => [
            'src'  => '/assets/3rdparty/lozad.min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'owl'  => [
            'src' => '/assets/3rdparty/owl-carousel/owl.carousel.min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'slick'  => [
            'src' => '/assets/3rdparty/slick/slick.min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'match-height'  => [
            'src' => '/assets/3rdparty/jquery.matchHeight-min.js',
            'deps' => ['jquery']
        ],
        'sticky'  => [
            'src' => '/assets/3rdparty/jquery.sticky-kit.min.js',
            'deps' => ['jquery']
        ],
        'waypoints'  => [
            'src' => '/assets/3rdparty/jquery.waypoints.min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'isotope' => [
            'src'  => '/assets/3rdparty/isotope.pkgd.min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'snap' => [
            'src' => '/assets/3rdparty/snap.svg-min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'gsap' => [
            'src' => '/assets/3rdparty/TweenMax.min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'gsapMorph' => [
            'src' => '/assets/3rdparty/MorphSVGPlugin.min.js',
            'deps' => ['jquery'],
            'enqueue' => false,
        ],
        'imagesloaded'     => [
            'src'  => '/assets/3rdparty/imagesloaded.pkgd.min.js',
            'deps' => ['jquery'],
        ],
        'cookie-notice' => [
            'src' => '/assets/js/cookie-notice.js',
            'deps' => ['jquery'],
        ],
        'sliders' => [
            'src'  => '/assets/js/sliders.js',
            'deps' => ['jquery', 'imagesloaded'],
            'enqueue' => false,
        ],
        'map' => [
            'src'  => '/assets/js/map.js',
            'deps' => ['jquery', 'google-maps-api'],
            'enqueue' => false,
        ],
        'scripts' => [
            'src'  => '/assets/js/scripts.js',
            'deps' => ['jquery', 'imagesloaded'],
        ],
        'bootstrap' => [
            'src' => '/assets/3rdparty/bootstrap/js/bootstrap.js',
            'deps' => ['jquery'],
            'enqueue' => true,
        ],
    ],
    'localize' => [
        'scripts' => [
            'prefix'  => 'api',
            'strings' => [
                'ajaxUrl' => admin_url('admin-ajax.php'),
            ]
        ]
    ],
    'bundles' => [
        'owl' => [
            [
                'styles' => ['owl'],
                'scripts' => ['owl'],
            ]
        ],
        'slick' => [
            [
                'styles' => ['slick'],
                'scripts' => ['slick'],
            ]
        ],
        'sliders' => [
            [
                'styles' => ['owl'],
                'scripts' => ['owl'],
            ],
            [
                'scripts' => ['sliders'],
            ]
        ],
        'map' => [
            [
                'scripts' => [
                    'google-maps-api',
                    'map'
                ]
            ]
        ],
        'bootstrap' => [
            [
                'styles' => ['bootstrap'],
                'scripts' => ['bootstrap'],
            ]
        ],
    ],
];
