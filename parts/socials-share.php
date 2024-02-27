<?php if (have_rows('socials_for_share', 'options')) : ?>
    <ul class="stay-tuned">
        <?php while (have_rows('socials_for_share', 'options')) :
            the_row(); ?>
            <?php $social_network = get_sub_field('social_network'); ?>
            <li class="stay-tuned__item">
                <a class="stay-tuned__link"
                   href="<?php echo getShareLink($social_network['value']); ?>"
                   target="_blank"
                   aria-label="<?php echo $social_network['label']; ?>"
                   rel="noopener">
                    <span aria-hidden="true" class="fab fa-<?php echo $social_network['value']; ?>"></span>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php endif; ?>
