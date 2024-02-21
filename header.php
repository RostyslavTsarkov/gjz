<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Set up Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">

    <!-- Add external fonts below (GoogleFonts / Typekit) -->
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class('no-outline fxy'); ?>>
<?php wp_body_open(); ?>

<!-- <div class="preloader hide-for-medium">
    <div class="preloader__icon"></div>
</div> -->

<!-- BEGIN of header -->
<header class="header">
    <div class="grid-container menu-grid-container">
        <div class="grid-x grid-margin-x">
            <div class="large-4 medium-3 small-9 cell medium-order-1 small-order-1">
                <div class="logo text-center medium-text-left">
                    <div class="grid-x column-gap-35 align-middle">
                        <div class="grid-x align-middle column-gap-20">
                            <?php show_custom_logo(); ?>
                            <span class="site-title h6 text-uppercase font-weight-900"><?php echo get_bloginfo('name'); ?></span>
                        </div>
                        <span class="site-subtitle font-size-100 text-uppercase metallic-silver"><?php the_field('site_subtitle', 'options'); ?></span>
                    </div>
                </div>
            </div>
            <div class="large-7 medium-7 small-12 cell medium-order-2 small-order-3">
                <div class="grid-x align-center">
                    <?php if (has_nav_menu('header-menu')) : ?>
                        <div class="title-bar hide-for-medium" data-responsive-toggle="main-menu" data-hide-for="medium">
                            <button class="menu-icon" type="button" data-toggle aria-label="Menu" aria-controls="main-menu">
                                <span></span></button>
                        </div>
                        <nav class="top-bar" id="main-menu">
                            <?php wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'menu_class' => 'menu header-menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown" data-submenu-toggle="true" data-multi-open="false" data-close-on-click-inside="false">%3$s</ul>',
                                'walker' => new theme\FoundationNavigation()
                            )); ?>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
            <div class="large-1 medium-2 small-3 cell medium-order-3 small-order-2">
                <div class="grid-x align-right">
                    <?php if (have_rows('site_languages', 'options')) : ?>
                        <?php while (have_rows('site_languages', 'options')) :
                            the_row() ?>
                                <ul class="cell">
                                    <?php $divider = get_sub_field('divider'); ?>
                                    <?php if (have_rows('languages')) : ?>
                                        <?php while (have_rows('languages')) :
                                            the_row(); ?>
                                                <?php if ('en' == get_sub_field('short_name')) : ?>
                                                    <span class="font-size-100 font-weight-900 black-coral"><?php the_sub_field('short_name'); ?></span>
                                                <?php else : ?>
                                                    <span class="font-size-100 roman-silver"><?php the_sub_field('short_name'); ?></span>
                                                <?php endif; ?>
                                                <span class="font-size-100 roman-silver"><?php echo $divider; ?></span>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- END of header -->
