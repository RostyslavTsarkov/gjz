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
                    autoplay: false,
                    pauseOnHover: true,
                    autoplaySpeed: 1000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rows: 0, // Prevent generating extra markup
                    slide: '.slick-slide', // Cause trouble with responsive settings
                });

                jQuery('#toggle-autoplay').click( function() {
                    if (jQuery(this).html() == '<i class="fa-solid fa-pause"></i>') {
                        jQuery('.home-slider').slick('slickPause')
                        jQuery(this).html('<i class="fa-solid fa-play"></i>')
                    } else {
                        jQuery('.home-slider').slick('slickPlay')
                        jQuery(this).html('<i class="fa-solid fa-pause"></i>')
                    }
                });

                jQuery('.home-slider').slickLightbox();
            }
        });
    </script>

    <?php if ($images = get_field('project_slide_images')) : ?>
    <div class="grid-container">
        <div id="home-slider" class="slick-slider home-slider">
            <?php foreach ($images as $image) : ?>
                <div class="slick-slide home-slide">
                    <div class="home-slide__inner single" <?php bg($image['url']); ?>>
                        <a id="toggle-lightbox" class="slick-button lightbox"
                           href="<?php echo $image['url']; ?>" target='_blank'>
                            <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="rel-content">
            <div id="toggle-autoplay" class="slick-button autoplay">
                <i class="fa-solid fa-play"></i>
            </div>
        </div>
    </div>
    <?php endif;
    wp_reset_query();

    return ob_get_clean();
};
