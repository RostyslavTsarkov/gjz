<?php

// PROJECTS Slider Shortcode
add_shortcode('projects-slider', function () {
    ob_start();
    ?>
    <script type="text/javascript">
        jQuery(document).on('ready', function() {
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
    $slider = new WP_Query([
        'post_type' => 'project',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'posts_per_page' => 5,
    ]);
    if ($slider->have_posts()) : ?>
    <div class="grid-container full">
        <div id="home-slider" class="slick-slider home-slider">
            <?php while ($slider->have_posts()) :
                $slider->the_post(); ?>
                <div class="slick-slide home-slide">
                    <div class="home-slide__inner" <?php bg(esc_url(get_field('project_slide_images')[0]['url']), 'full_hd'); ?>>
                        <div class="grid-container home-slide__caption">
                            <div class="grid-x grid-margin-x">
                                <div class="cell">
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div><!-- END of  #home-slider-->
    </div>
    <?php endif;
    wp_reset_query();

    return ob_get_clean();
});
