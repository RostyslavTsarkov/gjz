<!-- BEGIN of Project -->
<article id="post-<?php the_ID(); ?>" <?php post_class('project-block masonry-item preview preview--' . get_post_type()); ?>>
    <div class="grid-y">
        <?php if ($gallery = get_field('project_slide_images')) : ?>
            <div class="cell rel-content project-block__featured-img--container">
                <?php echo wp_get_attachment_image($gallery[0]['id'], false, false, array('class' => 'project-block__featured-img')); ?>
            </div>
        <?php endif; ?>
        <div class="cell">
            <h6 class="preview__title">
                <a href="<?php the_permalink(); ?>"
                   title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'fxy'), the_title_attribute('echo=0'))); ?>"
                   rel="bookmark"><?php echo get_the_title() ?: __('No title', 'fxy'); ?>
                </a>
            </h6>
            <p><?php echo get_the_terms(get_the_ID(), 'client')[0]->name; ?></p>
        </div>
        <div class="">
            <a href="<?php the_permalink(); ?>"
               title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'fxy'), the_title_attribute('echo=0'))); ?>"
               rel="bookmark">
                details
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
    </div>
</article>
<!-- END of Project -->
