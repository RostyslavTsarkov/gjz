<?php
/**
 * Single
 *
 * Loop container for single project content
 */
get_header(); ?>

<main class="main-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) :
                the_post(); ?>
                <!-- START of categories -->
                <div class="grid-container">
                    <div class="grid-x">
                        <div class="cell medium-5">
                            <h3><?php echo get_the_title(wp_get_post_parent_id()); ?></h3>
                        </div>
                        <div class="cell medium-7">
                            <?php $terms = get_terms([
                                'taxonomy' => 'project-type',
                                'hide_empty' => false,
                            ]); ?>

                            <?php foreach ($terms as $term) : ?>
                                <a class=""
                                   href="<?php echo get_term_link($term); ?>">
                                    <?php echo $term->name; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- END of categories -->

                <!-- START of title -->
                <div class="grid-container">
                    <div class="grid-x">
                        <div class="cell medium-8">
                            <h2 class="page-title entry__title"><?php the_title(); ?></h2>
                        </div>
                        <div class="cell medium-4">
                            <a>prev project</a>
                            <a>next project</a>
                        </div>
                    </div>
                </div>
                <!-- END of title -->

                <!--PROJECT PAGE SLIDER-->
                <?php if (shortcode_exists('project-slider')) {
                    echo do_shortcode('[project-slider]');
                } ?>
                <!--END of PROJECT PAGE SLIDER-->

                <!-- BEGIN of project content -->
                <div class="grid-container">
                    <div class="grid-x grid-margin-x">
                        <div class="cell medium-8">
                            <div class="grid-y grid-margin-y entry__content clearfix">
                                <h5>THE BASICS</h5>
                                <div class="grid-x grid-margin-x large-up-5 medium-up-3 small-up-2">
                                    <div class="cell">
                                        <p class="text-uppercase">
                                            Client:
                                            <br>
                                            <?php if ($term = get_field('project_client')) {
                                                echo esc_html($term->name);
                                            } ?>
                                        </p>
                                    </div>
                                    <div class="cell">
                                        <p class="">
                                            When:
                                            <br>
                                            <?php the_field("project_when"); ?>
                                        </p>
                                    </div>
                                    <div class="cell">
                                        <p class="">
                                            Where:
                                            <br>
                                            <?php if ($terms = get_field('project_where')) : ?>
                                                <?php foreach ($terms as $term) : ?>
                                                    <?php echo esc_html($term->name); ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="cell">
                                        <p class="">
                                            Scope:
                                            <br>
                                            <?php if ($terms = get_field('project_type')) : ?>
                                                <?php foreach ($terms as $term) : ?>
                                                    <?php echo esc_html($term->name); ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="cell">
                                        <p class="">
                                            Size:
                                            <br>
                                            <?php if ($size = get_field('project_size')) : ?>
                                                <?php echo $size; ?>sqr
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="cell">
                                    <?php the_field('project_description') ?>
                                </div>
                                <div class="cell">
                                    <?php if ($button = get_field('project_download_button')) : ?>
                                    <a class="button large" href="<?php $button['file'] ?>" download>
                                        <i class="fa-solid fa-download"></i>
                                        <?php echo $button['placeholder'] ?>
                                    </a>
                                    <?php endif; ?>
                                </div>
                                <div class="cell">
                                    <div class="grid-x">
                                        <div class="cell medium-6">
                                            <p>SHARE: <?php get_template_part('parts/socials');?></p>
                                        </div>
                                        <div class="cell medium-6">
                                            <a>prev project</a>
                                            <a>next project</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cell medium-offset-1 medium-3">
                            <div class="grid-y grid-margin-y">
                                <?php if ($add_info = get_field('project_additional_information')) : ?>
                                    <div class="cell">
                                        <?php echo $add_info; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (have_rows('project_team')) : ?>
                                    <div class="cell">
                                        <h6>THE TEAM</h6>
                                        <?php while (have_rows('project_team')) :
                                                the_row();?>
                                            <p><?php echo esc_html(get_sub_field('position')->name); ?>, <?php the_sub_field('full_name'); ?></p>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END of project content -->
            <?php endwhile; ?>
        <?php endif; ?>
    </article>
</main>
<?php get_footer(); ?>
