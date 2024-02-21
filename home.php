<?php
/**
 * Home
 *
 * Standard loop for the blog-page
 */
get_header(); ?>

<main class="main-content">
    <div class="grid-container">
        <div class="grid-x grid-margin-xt">
            <!-- BEGIN of Blog posts //posts-list-->
            <section class="cell">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) :
                        the_post(); ?>
                        <?php get_template_part('parts/loop', 'post'); // Project item?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <!-- BEGIN of pagination -->
                <?php foundation_pagination(); ?>
                <!-- END of pagination -->
            </section>
            <!-- END of Blog posts -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
