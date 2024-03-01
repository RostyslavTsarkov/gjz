<?php

// PROJECTS Slider Shortcode
add_shortcode('projects-slider', 'featured_projects');

function featured_projects($atts)
{
    $atts = shortcode_atts(array(
        'term' => '',
    ), $atts, 'projects-slider');

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
                    arrows: false,
                });
            }
        });
    </script>

    <?php
    if ($atts['term'] == '') {
        $slider = new WP_Query([
            'post_type' => 'project',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => 5,
            'meta_key' => 'is_featured_project',
            'meta_value' => '1',
        ]);
    } else {
        $slider = new WP_Query([
            'post_type' => 'project',
            'tax_query' => array(
                array (
                    'taxonomy' => 'project-type',
                    'field' => 'slug',
                    'terms' => $atts['term'],
                )
            ),
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => 5,
            'meta_key' => 'is_featured_project',
            'meta_value' => '1',
        ]);
    }

    if ($slider->have_posts()) : ?>
    <div class="grid-container full">
        <div id="home-slider" class="slick-slider home-slider">
            <?php while ($slider->have_posts()) :
                $slider->the_post(); ?>
                <div class="slick-slide home-slide">
                    <div class="home-slide__inner" <?php bg(esc_url(get_field('project_slide_images')[0]['url']), 'full_hd'); ?>>
                    </div>
                    <div class="home-slide__caption">
                        <div class="grid-x">
                            <div class="cell">
                                <span class="slide__post-link grid-x align-justify align-middle" onclick="location='<?php the_permalink(); ?>'"  style="cursor: pointer">
                                    <h5 class="small-6 text-uppercase font-weight-300"><?php the_title(); ?></h5>
                                    <div class="small-6">
                                        <div class="grid-y">
                                            <div class="grid-x align-right font-size-150 roman-silver">
                                                <?php if ($client = get_field('project_client')) {
                                                    echo esc_html($client->name);
                                                } ?>
                                            </div>
                                            <div class="grid-x align-right dark-gunmetal">
                                                <?php echo get_the_term_list(get_the_ID(), 'project-type', '', ',', ''); ?>
                                            </div>
                                        </div>
                                    </div>
                                </span>
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
};
