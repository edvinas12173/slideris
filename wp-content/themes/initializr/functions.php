<?php

/* Load dependencies */

$dependencies = array(
    '/src/core/*.php',
    '/src/*.php',
    '/src/entity/*.php',
    '/src/widget/*.php',
);

foreach ($dependencies as $dir) {
    foreach (glob(get_template_directory() . $dir) as $file) {
        include_once $file;
    }
}

new App\Setup();

new App\LazyLoader();

new App\Admin();

new App\Theme();

new App\SEO();

new App\CookieNotice();

new App\PopupLoader();
