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
        <div class="cell">
            <div class="about__category-list grid-x grid-margin-x grid-margin-y medium-up-3 small-up-1">
                <?php
                $args = array(
                    'taxonomy'   => 'project-type',
                    'orderby'    => 'id',
                    'order'      => 'ASC',
                    'hide_empty' => false,
                );
                $terms = get_terms($args); ?>
                <?php if (! empty($terms) && is_array($terms)) :
                    foreach ($terms as $term) : ?>
                        <article class="cell category-block">
                            <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                <h6 class="text-lowercase font-size-350 font-weight-700"><?php echo $term->name; ?></h6>
                            </a>
                            </a>
                            <p class="category-block__description font-size-250 font-weight-300 black-coral"><?php echo $term->description; ?></p>
                            <a href="<?php echo esc_url(get_term_link($term)); ?>"
                                class="font-size-300 fa-solid fa-chevron-right"></a>
                        </article>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </div>
</section>
<ar
<!-- END of main content -->

<?php get_footer(); ?>
