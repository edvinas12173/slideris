<?php if (get_field('cb_enabled', 'option')) : ?>
    <div id="cookie-notice" class="cookie-notice js-cookie-notice">
        <div class="cookie-notice__message">
            <?php echo nl2br(stripslashes(get_field('cb_message', 'option'))) ?>
        </div>
        <div class="h-tac">
            <button class="js-cookie-accept cookie-notice__btn-accept btn--primary" name="button" type="button"><?php echo get_field('cb_accept_label', 'option') ?></button>
        </div>
    </div>
<?php endif; ?>
