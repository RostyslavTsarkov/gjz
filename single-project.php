<?php
/**
 * Single
 *
 * Loop container for single project content
 */
get_header(); ?>

<main class="main-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
        <?php if (have_posts()) :
            while (have_posts()) :
                the_post(); ?>
                <!-- START of categories -->
                <div class="grid-container">
                    <div class="grid-x row-gap-10">
                        <div class="cell large-4">
                            <h4 class="font-weight-900 text-uppercase metallic-silver "><?php the_field('projects_taxonomy_title', 'options'); ?></h4>
                        </div>
                        <div class="cell large-8 font-size-200 text-lowercase">
                            <?php if ($terms = get_field('project_featured_terms', 'options')) :
                                $post_terms = wp_get_post_terms(get_the_ID(), 'project-type', array('fields' => 'ids')); ?>

                                <ul class="term-list grid-x list-unstyled column-gap-30 align-bottom align-right medium-align-center">
                                    <li>
                                        <a class="roman-silver"
                                           href="<?php echo get_post_type_archive_link('project'); ?>">
                                            all
                                        </a>
                                    </li>
                                    <?php foreach ($terms as $term) : ?>
                                        <li>
                                            <?php $is_in_array = false;
                                            foreach ($post_terms as $local_term) {
                                                if ($term == $local_term) {
                                                    $is_in_array = true;
                                                    break;
                                                }
                                            }

                                            if ($is_in_array) {
                                                $color = 'dark-gunmetal';
                                            } else {
                                                $color = 'roman-silver';
                                            } ?>
                                            <a class="<?php echo $color ?>"
                                               href="<?php echo esc_url(get_term_link($term)); ?>">
                                                <?php echo get_term($term)->name; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- END of categories -->

                <!-- START of title -->
                <div class="grid-container">
                    <div class="grid-x">
                        <div class="cell large-9">
                            <h2 class="page-title entry__title font-weight-700"><?php the_title(); ?></h2>
                        </div>
                        <div class="cell large-3">
                            <div class="project-buttons grid-x column-gap-30 font-size-300 font-weight-300 align-bottom align-right">
                                <?php echo get_previous_post_link(
                                    $format = '<i>' . '%link' . '</i>',
                                    $link = __('prev project', 'fwp'),
                                    $in_same_term = true,
                                    $excluded_terms = '',
                                    $taxonomy = 'project-type'
                                );
                                echo get_next_post_link(
                                    $format = '<i>' . '%link' . '</i>',
                                    $link = __('next project', 'fwp'),
                                    $in_same_term = true,
                                    $excluded_terms = '',
                                    $taxonomy = 'project-type'
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END of title -->

                <!--PROJECT PAGE SLIDER-->
                <?php
                if (shortcode_exists('project-slider')) {
                    echo do_shortcode('[project-slider]');
                } ?>
                <!--END of PROJECT PAGE SLIDER-->

                <!-- BEGIN of project content -->
                <div class="project-content grid-container">
                    <div class="grid-x row-gap-30 align-justify">
                        <div class="project-content__column--left large-auto small-12">
                            <div class="grid-x grid-margin-x entry__content clearfix row-gap-60">
                                <div class="cell">
                                    <div class="grid-x row-gap-20">
                                        <div class="cell">
                                            <h6 class="font-weight-600"><?php _e('THE BASICS', 'fwp'); ?></h6>
                                        </div>
                                        <div class="cell">
                                            <div class="grid-x column-gap-30 row-gap-20 align-justify medium-align-right font-size-250">
                                                <?php if ($clients = get_the_terms(get_the_ID(), 'client')) : ?>
                                                    <div class="">
                                                        <span class="font-size-200 roman-silver"><?php _e('Client:', 'fwp'); ?></span>
                                                        <br>
                                                        <span>
                                                            <?php foreach ($clients as $i => $client) :
                                                                echo esc_html($client->name);
                                                                if ($i != count($clients) - 1) {
                                                                    _e(', ', 'fwp');
                                                                }
                                                            endforeach; ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($when = get_field('project_when')) : ?>
                                                    <div class="">
                                                        <span class="font-size-200 roman-silver"><?php _e('When:', 'fwp'); ?></span>
                                                        <br>
                                                        <span><?php echo $when; ?></span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($locations = get_the_terms(get_the_ID(), 'location')) : ?>
                                                    <div class="">
                                                        <span class="font-size-200 roman-silver"><?php _e('Where:', 'fwp'); ?></span>
                                                        <br>
                                                        <span>
                                                            <?php $locations = array_reverse($locations);
                                                            foreach ($locations as $i => $location) :
                                                                echo esc_html($location->name);
                                                                if ($i != count($locations) - 1) {
                                                                    _e(', ', 'fwp');
                                                                }
                                                            endforeach; ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($types = get_the_terms(get_the_ID(), 'project-type')) : ?>
                                                    <div class="scope-cell">
                                                        <span class="font-size-200 roman-silver"><?php _e('Scope:', 'fwp'); ?></span>
                                                        <br>
                                                        <span>
                                                            <?php foreach ($types as $i => $type) :
                                                                echo esc_html($type->name);
                                                                if ($i != count($types) - 1) {
                                                                    _e(', ', 'fwp');
                                                                }
                                                            endforeach; ?>
                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($size = get_field('project_size')) : ?>
                                                <div class="">
                                                    <span class="font-size-200 roman-silver"><?php _e('Size:', 'fwp'); ?></span>
                                                    <br>
                                                    <span><?php echo number_format($size); ?></span>
                                                    <span><?php _e('sqm', 'fwp'); ?></span>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="grid-x row-gap-30">
                                        <?php if ($description = get_field('project_description')) : ?>
                                            <div class="cell font-size-400 font-weight-300 roman-silver">
                                                <?php echo $description; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($button = get_field('project_download_button')) : ?>
                                        <div class="cell">
                                            <div class="grid-x medium-align-center">
                                                <a class="button download text-uppercase lotion roman-silver" href="<?php $button['file'] ?>" download>
                                                    <i class="fa-solid fa-download font-size-400"></i>
                                                    <?php echo $button['placeholder'] ?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="cell">
                                    <div class="grid-x row-gap-20">
                                        <div class="cell medium-6">
                                            <div class="grid-x align-middle column-gap-20 roman-silver">
                                                <span class="font-size-200 font-weight-700"><?php _e('SHARE:', 'fwp'); ?></span>
                                                <div><?php get_template_part('parts/socials-share');?></div>
                                            </div>
                                        </div>
                                        <div class="cell medium-6">
                                            <div class="project-buttons grid-x column-gap-30 font-size-300 font-weight-300 align-bottom align-right">
                                                <?php echo get_previous_post_link(
                                                    $format = '<i>' . '%link' . '</i>',
                                                    $link = __('prev project', 'fwp'),
                                                    $in_same_term = true,
                                                    $excluded_terms = '',
                                                    $taxonomy = 'project-type'
                                                );
                                                echo get_next_post_link(
                                                    $format = '<i>' . '%link' . '</i>',
                                                    $link = __('next project', 'fwp'),
                                                    $in_same_term = true,
                                                    $excluded_terms = '',
                                                    $taxonomy = 'project-type'
                                                ); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="project-content__column--right large-auto small-12">
                            <div class="grid-x">
                                <?php if ($add_info = get_field('project_additional_information')) : ?>
                                    <div class="cell project-content__add-info">
                                        <?php echo $add_info; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($team = get_field('project_team')) : ?>
                                    <div class="cell roman-silver">
                                        <h6><?php _e('THE TEAM', 'fwp'); ?></h6>
                                        <?php foreach ($team as $i => $member) : ?>
                                            <div class="font-size-250 font-weight-300">
                                                <?php echo esc_html($member['position']->name) . '. ' . esc_html($member['full_name']);
                                                if ($i != count($team) - 1) {
                                                    echo ', ';
                                                } ?>
                                            </div>
                                        <?php endforeach; ?>
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
