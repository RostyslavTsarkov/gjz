<?php
/**
 * Category
 *
 * Standard loop for the archive page
 */

get_header(); ?>

<main class="main-content">
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
            <div class="cell">
                <div class="projects__title-bar grid-x grid-margin-x">
                    <div class="cell large-4"">
                        <h1 class="font-weight-800 text-uppercase">
                            <?php if ($title = get_field('projects_archive_title', 'options')) {
                                echo $title;
                            } else {
                                the_archive_title();
                            }
                            ?>
                        </h1>
                    </div>
                    <div class="cell large-8 font-size-200 text-lowercase ">
                        <?php $terms = get_terms([
                            'taxonomy' => 'project-type',
                            'orderby'    => 'id',
                            'hide_empty' => false,
                        ]); ?>

                        <?php if ($terms) : ?>
                            <ul class="term-list grid-x list-unstyled column-gap-30 align-bottom align-right medium-align-center">
                                <li>
                                    <a class="dark-gunmetal"
                                       href="<?php echo get_post_type_archive_link('project'); ?>">
                                        all
                                    </a>
                                </li>
                                <?php foreach ($terms as $term) : ?>
                                    <li>
                                        <a class="roman-silver"
                                           href="<?php echo esc_url(get_term_link($term)); ?>">
                                            <?php echo $term->name; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))) : ?>
            <!-- BEGIN of Featured posts slider -->
            <section class="cell">
                <?php if (shortcode_exists('projects-slider')) {
                    echo do_shortcode('[projects-slider term="' . $term->slug . '"]');
                } ?>
            </section>
            <!--END of Featured posts slider -->

            <!-- BEGIN of Category information -->
            <section class="category-section cell">
                <div class="grid-x row-gap-20">
                    <div class="cell">
                        <div class="grid-x grid-margin-x">
                            <div class="cell large-7">
                                <h3 class="category-section__title font-weight-500 text-uppercase"><?php echo $term->name; ?></h3>
                            </div>
                            <div class="cell large-5">
                                <div class="grid-y align-right row-gap-10">
                                    <?php if ($add = get_field('category_additional_information', $term)) : ?>
                                        <div class="cell medium-offset-5 medium-7 font-size-150 font-weight-900">
                                            <div class="grid-x align-right">
                                                <?php echo $add['title']; ?>
                                            </div>
                                        </div>
                                        <div class="cell large-offset-6 medium-offset-7 large-6 medium-5 roman-silver">
                                            <div class="grid-x text-right align-right">
                                                <?php echo $add['short_description']; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell">
                        <div class="grid-x grid-margin-x grid-margin-y">
                            <div class="cell large-7 large-order-1 medium-order-2 small-order-2">
                                <div class="grid-y rel-content row-gap-30">
                                    <?php if ($description = get_field('category_long_description', $term)) : ?>
                                        <div class="category-section__description cell font-size-450 font-weight-300">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($button = get_field('category_download_button', $term)) : ?>
                                        <div class="cell">
                                            <div class="grid-x align-right medium-align-center">
                                                <a class="button download text-uppercase" href="<?php $button['file'] ?>" download>
                                                    <i class="fa-solid fa-download font-size-400"></i>
                                                    <?php echo $button['placeholder']; ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="cell large-5 rel-content medium-order-1 small-order-1">
                                <?php if ($img = get_field('category_featured_image', $term)) : ?>
                                    <?php echo wp_get_attachment_image($img, false, false, array('class' => 'category-section__featured-img stretched-img')); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            </section>
            <!--END of Category information -->

            <!-- BEGIN of Archive posts -->
            <section class="projects__masonry-grid cell">
                <div class="masonry-grid">
                    <?php $args = array(
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
            <!-- END of Archive posts -->
        </div>
</main>

<?php get_footer(); ?>
