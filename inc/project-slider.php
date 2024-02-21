<?php

// HOME Slider Shortcode
add_shortcode('project-slider', function () {
    ob_start();
    ?>
    <script type="text/javascript">
        // Send command to iframe youtube player
        function postMessageToPlayer(player, command) {
            if (player == null || command == null) return;
            player.contentWindow.postMessage(JSON.stringify(command), '*');
        }

        jQuery(document).on('ready', function() {
            var $homeSlider = jQuery('#home-slider');
            $homeSlider
                .on('init', function(event, slick) {
                    slick.$slides.not(':eq(0)').find('.video--local').each(function() {
                        this.pause();
                    });

                    if (slick.$slides.eq(0).find('.video--local').length) {
                        slick.$slides.eq(0).find('.video--local')[0].play();
                    }
                    if (slick.$slides.eq(0).find('.video--embed').length) {
                        var playerId = slick.$slides.eq(0).find('iframe').attr('id');
                        var player = jQuery('#' + playerId).get(0);
                        postMessageToPlayer(player, {
                            'event': 'command',
                            'func': 'playVideo',
                        });
                    }
                })
                .on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                    // Pause youtube video on slide change
                    if (slick.$slides.eq(currentSlide).find('.video--embed').length) {
                        var playerId = slick.$slides.eq(currentSlide).find('iframe').attr('id');
                        var player = jQuery('#' + playerId).get(0);
                        postMessageToPlayer(player, {
                            'event': 'command',
                            'func': 'pauseVideo',
                        });
                    }
                    // Pause local video on slide change
                    if (slick.$slides.eq(currentSlide).find('.video--local').length) {
                        slick.$slides.eq(currentSlide).find('.video--local')[0].pause();
                    }

                })
                .on('afterChange', function(event, slick, currentSlide) {
                    // Start playing local video on current slide
                    if (slick.$slides.eq(currentSlide).find('.video--local').length) {
                        slick.$slides.eq(currentSlide).find('.video--local')[0].play();
                    }

                    // Start playing youtube video on current slide
                    if (slick.$slides.eq(currentSlide).find('.video--embed').length) {
                        var playerId = slick.$slides.eq(currentSlide).find('iframe').attr('id');
                        var player = jQuery('#' + playerId).get(0);
                        postMessageToPlayer(player, {
                            'event': 'command',
                            'func': 'playVideo',
                        });
                    }
                });

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
        'posts_per_page' => -1
    ]);
    if ($slider->have_posts()) : ?>
    <div class="grid-container">
        <div id="home-slider" class="slick-slider home-slider">
            <?php while ($slider->have_posts()) :
                $slider->the_post(); ?>
                <div class="slick-slide home-slide">
                    <div class="home-slide__inner" <?php bg(get_attached_img_url(get_the_ID(), 'full_hd')); ?>>
                        <div class="grid-container home-slide__caption">
                            <div class="grid-x grid-margin-x">
                                <div class="cell">

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
