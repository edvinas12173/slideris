<?php
    use App\Image;

    $args = array(
        'post_type'   => 'sliders',
        'order'       => 'ASC',
        'numberposts' => -1,
    );

    $items = get_posts( $args );
?>
<section class="slider">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($items as $key => $item) { ?>
                            <div class="swiper-slide">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12">
                                            <div class="slider-block">
                                                <div class="slider-number">
                                                    <?php
                                                        $newKey = $key + 1;

                                                        if ($newKey <= 10) {
                                                            echo "0" . $newKey;
                                                        } else {
                                                            echo $newKey;
                                                        }
                                                    ?>
                                                </div>
                                                <div class="slider-title">
                                                    <?php echo $item->post_title ?>
                                                </div>
                                                <div class="slider-content">
                                                    <?php echo get_field('content', $item->ID) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 text-center">
                                            <?php
                                                Image::img([
                                                    'src' => get_field('image', $item->ID),
                                                ], false)
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="swiper-custom-block">
                        <div class="row">
                            <div class="col-1">
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div class="col-10">
                                <div class="swiper-scrollbar"></div>
                            </div>
                            <div class="col-1">
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>

                    <div class="scrollbarNumber">01</div>
                </div>
            </div>
        </div>
    </div>
</section>