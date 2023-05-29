<?php
if (function_exists('icl_get_languages')) {
    $languages = icl_get_languages('skip_missing=N&link_empty_to=/');
    if (!empty($languages)) { ?>
        <ul class="h-menu language-menu h-fr h-clearfix">
            <?php foreach ($languages as $lang) : ?>
                <li class="<?php echo $lang['active'] ? 'is-active' : '' ?>">
                    <a href="<?php echo $lang['url'] ?>"><?php echo $lang['language_code'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}
