<?php
$copyright = get_field('copyright', 'option');
$parsed = false;
if (!empty($copyright)) {
    $copyright = str_replace('[year]', date('Y'), $copyright);
}
echo $copyright;
