<?php get_header(); ?>

<?php while(have_posts())  : ?>
    <?php the_post(); ?>

    <h1><?php the_Title() ?></h1>

    <?php the_content(); ?>

<?php endwhile; ?>

<?php get_footer(); ?>
