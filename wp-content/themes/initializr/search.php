<?php get_header(); ?>

<?php if (have_posts()): ?>

    <h1><?php printf(esc_html__('Search Results for: %s', 'initializr'),
            '<span>' . get_search_query() . '</span>'); ?></h1>


    <?php while (have_posts()): the_post(); ?>
        <?php the_content() ?>
    <?php endwhile; ?>

<?php else: ?>

    <h1><?php _e('Nothing Found', 'initializr'); ?></h1>
    <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.',
            'initializr') ?></p>

<?php endif; ?>

<?php get_footer(); ?>
