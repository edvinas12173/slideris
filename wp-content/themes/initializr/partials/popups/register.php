<?php
$popup  = $this->get('popup');
$formId = $popup->get('form_id');

?>
<div id="<?php echo $popup->getID() ?>" class="site-popup register-popup">
    <?php echo do_shortcode(sprintf('[contact-form-7 id="%s"]', $formId)) ?>
</div>
