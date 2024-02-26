<?php

// PROJECT Slider Shortcode
add_shortcode('project-slider', 'slider_images');

function slider_images($atts)
{
    $atts = shortcode_atts(array(
        'iamges' => '',
    ), $atts, 'project-slider');

    ob_start();
    ?>
    <script type="text/javascript">
        jQuery(document).on('ready', function() {
            var $homeSlider = jQuery('#home-slider');
            if (typeof jQuery('body').slick === 'function') {
                $homeSlider.slick({
                    cssEase: 'ease',
                    fade: true,  // Cause trouble if used slidesToShow: more than one
                    // arrows: false,
                    dots: true,
                    infinite: true,
                    speed: 500,
                    autoplay: true,
                    pauseOnHover: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rows: 0, // Prevent generating extra markup
                    slide: '.slick-slide', // Cause trouble with responsive settings
                });
            }
        });
    </script>

    <?php
    if ($images = get_field('project_slide_images')) : ?>
    <div class="grid-container">
        <div id="home-slider" class="slick-slider home-slider">
            <?php foreach ($images as $image) : ?>
                <div class="slick-slide home-slide">
                    <div class="home-slide__inner" <?php bg($image['url']); ?>>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- END of  #home-slider-->
    </div>
    <?php endif;
    wp_reset_query();

    return ob_get_clean();
};
