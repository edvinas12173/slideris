<?php
$popup      = $this->get('popup');
$link       = $popup->get('link');
$image      = $popup->get('image');

if (is_array($link)) {
    $url        = $link['url'];
    $target     = $link['target'];
} else {
    $url        = $link;
    $target     = '_self';
}

?>
<div id="<?php echo $popup->getID() ?>" class="site-popup image-popup">
    <a target="<?php echo $target ?>" href="<?php echo $url ?>">
        <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
    </a>
</div>
