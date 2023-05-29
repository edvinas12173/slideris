<?php
namespace App;
$images = get_sub_field('images');
?>
<?php if (!empty($images)): ?>
    <div class="images h-row">
        <?php foreach ($images as $image) : ?>
            <div class="images__item col-1-of-3">
                <?php
                Image::img(array(
                    'src' => $image['sizes']['large'],
                    'alt' => $image['alt'],
                    'title' => $image['caption'],
                ));
                ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
