<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

<!--HOME PAGE SLIDER-->
<?php if (shortcode_exists('slider')) {
    echo do_shortcode('[slider]');
} ?>
<!--END of HOME PAGE SLIDER-->

<!-- BEGIN of main content -->
<section class="about grid-container">
    <div class="grid-y">
        <div class="cell large-offset-3 medium-offset-1 large-9 medium-11">
            <h1 class="font-weight-900"><?php the_field('about_company_name'); ?></h1>
            <div class="font-size-500 font-weight-300 black-coral"><?php the_field('about_description'); ?></div>
        </div>
        <?php if ($terms = get_field('home_featured_categories')) : ?>
            <div class="cell">
                <div class="about__category-list grid-x grid-margin-x row-gap-20 align-justify medium-align-center">
                    <?php foreach ($terms as $term) : ?>
                        <article class="cell large-auto category-block">
                            <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                <h6 class="text-lowercase font-size-350 font-weight-700"><?php echo esc_html($term->name); ?></h6>
                            </a>
                            <p class="category-block__description font-size-250 font-weight-300 black-coral"><?php echo esc_html($term->description); ?></p>
                            <a href="<?php echo esc_url(get_term_link($term)); ?>"
                               class="font-size-300">
                                <div class="styled-arrow"></div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<ar
<!-- END of main content -->

<?php get_footer(); ?>
