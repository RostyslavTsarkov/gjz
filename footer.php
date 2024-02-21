<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
    <div class="grid-container">
        <div class="footer__content-wrapper grid-container rel-content">
            <?php if ($img = get_field('footer_featured_image', 'options')) : ?>
                <?php echo wp_get_attachment_image($img, false, false, array('class' => 'footer__featured-img')); ?>
            <?php endif; ?>
            <div class="grid-x">
                <div class="cell large-3 medium-5 small-7 rel-content font-weight-300 font-size-150">
                    <div class="grid-y row-gap-10">
                        <?php if ($title = get_field('footer_contact_title', 'options')) : ?>
                        <div class="cell">
                            <h6 class="font-size-100 font-weight-500 text-uppercase"><?php echo $title ?></h6>
                        </div>
                        <?php endif; ?>
                        <div class="cell">
                            <div class="grid-y row-gap-15">
                                <div class="cell">
                                    <p><?php the_field('address', 'options'); ?></p>
                                </div>
                                <div class="cell">
                                    <?php if ($phone = get_field('phone', 'options')) : ?>
                                        <p>Phone: <a href='<?php echo esc_url('tel:'.$phone); ?>'><?php echo $phone ?></a></p>
                                    <?php endif; ?>

                                    <?php if ($fax = get_field('fax', 'options')) : ?>
                                        <p>Fax: <a href='<?php echo esc_url('fax:'.$fax); ?>'><?php echo $fax; ?></a></p>
                                    <?php endif; ?>

                                    <?php if ($email = get_field('email', 'options')) : ?>
                                        <p><a href='<?php echo esc_url('mailto:'.$email); ?>'><?php echo $email; ?></a></p>
                                    <?php endif; ?>
                                </div>
                                <div class="cell footer__sp">
                                    <?php get_template_part('parts/socials');?>
                                </div>
                                <div class="cell">
                                    <?php if ($icp = get_field('icp', 'options')) : ?>
                                        <p class="font-weight-300 font-size-100">ICP <?php echo $icp ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell large-2 medium-3 small-3 rel-content">
                    <div class="grid-y row-gap-20">
                        <?php if ($title = get_field('footer_menu_title', 'options')) : ?>
                            <div class="cell">
                                <h6 class="font-size-100 font-weight-500 text-uppercase"><?php echo $title ?></h6>
                            </div>
                        <?php endif; ?>
                        <?php if (has_nav_menu('footer-menu')) : ?>
                            <div class="cell font-weight-300 text-lowercase font-size-200">
                                <?php wp_nav_menu(array('theme_location' => 'footer-menu', 'menu_class' => 'footer-menu', 'depth' => 1)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END of footer -->

<?php wp_footer(); ?>
</body>
</html>
