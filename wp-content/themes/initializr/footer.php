</main> <!-- .site-center -->

<footer role="contentinfo" class="site-footer">
    <?= wp_get_attachment_image(7) ?>
    <div class="site-footer-top">
        <div class="site-block">
            <div class="h-row">
                <?php dynamic_sidebar('footer') ?>
            </div>
        </div>
    </div>
    <div class="site-footer-bottom">
        <div class="site-block h-clearfix">
            <p class="site-copyrights h-fl">
                <?= do_shortcode('[copyright]') ?>
            </p>
        </div>
    </div>
</footer>

</div> <!-- .site -->

<?php wp_footer(); ?>

</body>

</html>
