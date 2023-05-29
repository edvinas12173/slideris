<?php

$prefix = !empty(get_query_var('section_prefix')) ? get_query_var('section_prefix') . '/' : '';

while (have_rows('sections')) {
    the_row();
    get_template_part('partials/sections/' . $prefix . get_row_layout());
}
