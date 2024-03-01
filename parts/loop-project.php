<!-- BEGIN of Project -->
<article id="post-<?php the_ID(); ?>" <?php post_class('project-block masonry-item preview preview--' . get_post_type()); ?>>
    <div class="grid-y row-gap-15">
        <?php if ($gallery = get_field('project_slide_images')) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <div class="cell rel-content project-block__featured-img--container">
                    <?php the_post_thumbnail('medium', array('class' => 'preview__thumb project-block__featured-img')); ?>
                </div>
            </a>
        <?php endif; ?>
        <div class="cell project-block__body">
            <div class="grid-y">
                <h6 class="preview__title font-weight-600 font-size-250">
                    <a href="<?php the_permalink(); ?>"
                       title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'fxy'), the_title_attribute('echo=0'))); ?>"
                       rel="bookmark"><?php echo get_the_title() ?: __('No title', 'fxy'); ?>
                    </a>
                </h6>
                <p class="roman-silver font-size-200">
                    <?php if ($client = get_field('project_client')) {
                        echo esc_html($client->name);
                    } ?>
                </p>
                <a class="text-right font-size-250"
                    href="<?php the_permalink(); ?>"
                   title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'fxy'), the_title_attribute('echo=0'))); ?>"
                   rel="bookmark">
                    <i>details</i>
                    <div class="styled-arrow"></div>
                </a>
            </div>
        </div>
    </div>
</article>
<!-- END of Project -->
