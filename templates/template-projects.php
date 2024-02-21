<?php
/**
 * Template Name: Projects Page
 */
get_header(); ?>

<main class="main-content">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell">
                <div class="grid-x grid-margin-x">
                    <h1 class="cell large-4"><?php wp_title('', true, 'right'); ?></h1>
                    <div class="cell large-8">

                    </div>
                </div>
            </div>

            <!-- BEGIN of Last posts slider -->
            <section class="cell">
                <!--HOME PAGE SLIDER-->
                <?php if (shortcode_exists('projects-slider')) {
                    echo do_shortcode('[projects-slider]');
                } ?>
                <!--END of HOME PAGE SLIDER-->
            </section>
            <!-- END of Blog posts -->

            <!-- BEGIN of Category info -->
            <section class="cell">
                <div class="grid-x grid-margin-x">
                    <div class="cell large-offset-1 large-up-6">

                    </div>
                    <div class="cell large-5">

                    </div>
                </div>
            </section>
            <!-- END of Category info -->

            <!-- BEGIN of Blog posts -->
            <section class="cell"> <!-- add posts-list class if needed -->
                <div class="masonry-grid">
                    <?php //$args = array(
//                        'post_type' => 'project',
//                        'tax_query' => array(
//                            array(
//                                'taxonomy' => 'project-type',
//                                'field' => 'slug',
//                                'terms' => 'design',
//                            ),
//                        ),
//                        'order' => 'ASC',
//                        'orderby' => 'menu_order',
//                        'posts_per_page' => -1,
//                    );

                    $args = array(
                        'post_type' => 'project',
                        'order' => 'ASC',
                        'orderby' => 'menu_order',
                        'posts_per_page' => -1,
                    );

                    $projects = new WP_Query($args); ?>

                    <?php if ($projects -> have_posts()) : ?>
                        <?php while ($projects -> have_posts()) :
                            $projects -> the_post(); ?>
                            <?php get_template_part('parts/loop', 'project'); // Project item?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <!-- BEGIN of pagination -->
                        <?php //foundation_pagination(); ?>
                    <!-- END of pagination -->
                </div>
            </section>
            <!-- END of Blog posts -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
