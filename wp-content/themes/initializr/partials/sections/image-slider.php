<?php
namespace App;
Assets::load('sliders');

$images = get_sub_field('images');
?>
<?php if (!empty($images)): ?>
    <div class="js-image-slider owl-carousel owl-theme image-slider">
        <?php foreach ($images as $image) : ?>
            <div class="image-slider__slide">
                <?php
                OwlImage::img(array(
                    'src' => $image['sizes']['large'],
                    'alt' => $image['alt'],
                    'title' => $image['caption'],
                ));
                ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
