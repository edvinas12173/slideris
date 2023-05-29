<?php
/* Template name: Flexible content */
get_header();

while (have_posts()) {
    the_post();
    get_template_part('partials/section-loop');
}

get_footer(); ?>
