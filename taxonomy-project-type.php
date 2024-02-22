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

            <!-- BEGIN of Featured posts slider -->
            <section class="cell">
                <?php if (shortcode_exists('projects-slider')) {
                    echo do_shortcode('[projects-slider]');
                } ?>
            </section>
            <!--END of Featured posts slider -->

            <!-- BEGIN of Category information -->
            <section class="cell">
                <?php if ($term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))) : ?>
                <div class="grid-x grid-margin-x">
                    <div class="cell large-7">
                        <div class="grid-y">
                            <div class="cell">
                                <?php echo $term->name; ?>
                            </div>
                            <?php if ($desctiption = get_field('category_long_description', $term)) : ?>
                                <div class="cell">
                                    <?php echo $desctiption; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($button = get_field('category_download_button', $term)) : ?>
                                <div class="cell">
                                    <a class="button large" href="<?php $button['file'] ?>" download>
                                        <i class="fa-solid fa-download"></i>
                                        <?php echo $button['placeholder'] ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="cell large-5">
                        <div class="category-section grid-y grid-margin-y">
                            <div class="">
                                <div class="grid-y">
                                    <?php if ($add = get_field('category_additional_information', $term)) : ?>
                                        <div class="cell">
                                            <?php echo $add['title']; ?>
                                        </div>
                                        <div class="cell">
                                            <?php echo $add['short_description']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="cell rel-content">
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
    </div>
</main>
<?php get_footer(); ?>
