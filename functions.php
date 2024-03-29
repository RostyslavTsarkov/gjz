<?php
/**
 * Functions
 */

// Declaring the assets manifest
$manifest_json = get_theme_file_path() . '/dist/assets.json';
$assets = [
    'manifest' => file_exists($manifest_json) ? json_decode(file_get_contents($manifest_json), true) : [],
    'dist' => get_theme_file_uri() . '/dist',
    'dist_path' => get_theme_file_path() . '/dist',
];
unset($manifest_json);

/**
 * Retrieve the path to the asset, use hashed version if exists
 *
 * @param $asset
 * @param boolean|string $path Defines if returned result is a path or a url (without leading slash if using path)
 *
 * @return string
 */
function asset_path($asset, $path = false)
{
    global $assets;
    $asset = isset($assets['manifest'][$asset]) ? $assets['manifest'][$asset] : $asset;
    return "{$assets[$path ? 'dist_path' : 'dist']}/{$asset}";
}

/******************************************************************************
 * Constants
 *****************************************************************************/
define('IMAGE_PLACEHOLDER', asset_path('images/placeholder.jpg'));

/******************************************************************************
 * Included Functions
 *****************************************************************************/
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

array_map(function ($file) {
    $file = "/inc/{$file}.php";
    if (!locate_template($file, true, true)) {
        echo sprintf(__('Error locating <code>%s</code> for inclusion.', 'fxy'), $file);
    }
}, [
    'helpers',
    'recommended-plugins',
    'class-foundation-navigation',
    'class-dynamic-admin',
    'class-lazyload',
    'theme-customizations',
    'home-slider',
    'projects-slider',
    'project-slider',
    'svg-support',
    'gravity-form-customizations',
    'custom-fields-search',
    'google-maps',
    'tiny-mce-customizations',
    'posttypes',
    'rest',
//    'gutenberg-support', // !!!IMPORTANT  Comment line 159 for enable Gutenberg
//    'woo-customizations',
//    'divi-support',
//    'elementor-support',
//    'shortcodes',
]);

// Register ACF Gravity Forms field
add_action('init', function () {
    if (class_exists('ACF')) {
        require_once 'inc/class-fxy-acf-field-gf-field-v5.php';
    }
});

// Prevent Fatal error on site if ACF not installed/activated
add_action('wp', function () {
    include_once 'inc/acf-placeholder.php';
}, PHP_INT_MAX);

/******************************************************************************
 * Enqueue Scripts and Styles for Front-End
 *****************************************************************************/
add_action('init', function () {
    wp_register_script('runtime.js', asset_path('scripts/runtime.js'), [], null, true);
    wp_register_script('vendor.js', asset_path('scripts/vendor.js'), [], null, true);
    if (file_exists(asset_path('styles/vendor.css', true))) {
        wp_register_style('vendor.css', asset_path('styles/vendor.css'), [], null);
    }
});

add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {
        // Disable gutenberg built-in styles
        // wp_dequeue_style('wp-block-library');

        wp_enqueue_script('jquery');

        wp_enqueue_style('vendor.css');
        wp_enqueue_style('main.css', asset_path('styles/main.css'), [], null);
        wp_enqueue_script(
            'main.js',
            asset_path('scripts/main.js'),
            ['jquery', 'runtime.js', 'vendor.js'],
            null,
            true
        );

        wp_localize_script(
            'main.js',
            'ajax_object',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('project_nonce'),
            ]
        );
    }
});

/******************************************************************************
 * Additional Functions
 *****************************************************************************/

// Dynamic Admin
if (class_exists('theme\DynamicAdmin') && is_admin()) {
    $dynamic_admin = new theme\DynamicAdmin();
//    $dynamic_admin->addField('page', 'template', __('Page Template', 'fxy'), 'template_detail_field_for_page');
    $dynamic_admin->run();
}

// Apply lazyload to whole page content
if (class_exists('theme\CreateLazyImg')) {
    add_action(
        'template_redirect',
        function () {
            ob_start(function ($html) {
                $lazy = new theme\CreateLazyImg;
                $buffer = $lazy->ignoreScripts($html);
                $buffer = $lazy->ignoreNoscripts($buffer);

                $html = $lazy->lazyloadImages($html, $buffer);
                $html = $lazy->lazyloadPictures($html, $buffer);
                $html = $lazy->lazyloadBackgroundImages($html, $buffer);

                return $html;
            });
        }
    );
}


/*********************** PUT YOU FUNCTIONS BELOW *****************************/

// Custom media library's image sizes
add_image_size('full_hd', 1920, 0, ['center', 'center']);
add_image_size('large_high', 1024, 0, false);
// add_image_size( 'name', width, height, ['center','center']);

// Disable gutenberg
add_filter('use_block_editor_for_post_type', '__return_false');

// Remove highlight form blog page when Projects page is open
function remove_blog_page_classe($classes, $item)
{
    if (( is_post_type_archive() || ! is_singular('post') ) && $item->type == 'post_type' && $item->object_id == get_option('page_for_posts')) {
        $classes = array_diff($classes, array( 'current_page_parent' ));
    }
    return $classes;
}

// Highlight Projects page when open anything with 'project' post type
function highlight_parent_template_item($classes = array(), $menu_item = false)
{
    if ('project' == get_post_type() && 'Projects' == $menu_item->title && !in_array('current_page_parent', $classes)) {
        $classes[] = 'current_page_parent';
    }
    return $classes;
}

function getShareLink($type, $post_id = false)
{
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $url = urlencode(get_permalink($post_id));
    $title = urlencode(get_the_title($post_id));
    $share_link = '';
    switch ($type) {
        case 'facebook': {
            $share_link = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
            break;
        }
        case 'twitter': {
            $share_link = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title;
            break;
        }
        case 'weibo': {
            $share_link = "http://service.weibo.com/share/share.php?url={$url}&appkey=&title={$title}&pic=&ralateUid=";
            break;
        }
        case 'wechat': {
            $share_link = "http://api.qrserver.com/v1/create-qr-code/?size=280x280&data={$url}";
            break;
        }
        case 'linkedin': {
            $share_link = "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}&summary=&source=";
            break;
        }
        case 'email':
        {
            $title = html_entity_decode(strip_tags($title), ENT_QUOTES, 'UTF-8');

            $title_urlencode = rawurlencode($title); //rawurlencode( htmlspecialchars( $title ) );
            $url_urlencode   = $url; //rawurlencode( htmlspecialchars( $url ) ) ;
            $share_link      = "https://www.addtoany.com/add_to/email?linkurl=$url_urlencode&linkname=$title_urlencode&linknote=";
            break;
        }
    }
    return $share_link;
}

function hwl_archive_projects_pagesize($query)
{
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('project')) {
        $number = get_field('projects_posts_per_page', 'options');

        $query->set('order', 'ASC');
        $query->set('orderby', 'menu_order');
        $query->set('posts_per_page', $number);

        return;
    }
}

function hwl_taxonomy_projects_pagesize($query)
{
    if (!is_admin() && $query->is_main_query() && is_tax('project-type')) {
        $number = get_field('projects_posts_per_page', 'options');

        $query->set('order', 'ASC');
        $query->set('orderby', 'menu_order');
        $query->set('posts_per_page', $number);
        $query->set('tax_query', array (
            'taxonomy' => 'project-type',
            'field' => 'slug',
            'terms' => get_queried_object()->term_id,
        ));

        return;
    }
}


add_filter('nav_menu_css_class', 'remove_blog_page_classe', 10, 2);
add_filter('nav_menu_css_class', 'highlight_parent_template_item', 10, 2);

add_action('pre_get_posts', 'hwl_archive_projects_pagesize', 1);
add_action('pre_get_posts', 'hwl_taxonomy_projects_pagesize', 1);
/*****************************************************************************/
