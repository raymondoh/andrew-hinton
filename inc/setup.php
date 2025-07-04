<?php
/**
 * Theme setup functions
 *
 * @package WP_Boilerplate
 */

if (!function_exists('wp_boilerplate_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function wp_boilerplate_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Register menus
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'wp-boilerplate'),
            'footer' => esc_html__('Footer Menu', 'wp-boilerplate'),
        ));

        // Switch default core markup to output valid HTML5.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('wp_boilerplate_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for custom logo.
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for responsive embeds.
        add_theme_support('responsive-embeds');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for block styles.
        add_theme_support('wp-block-styles');
    }
endif;
add_action('after_setup_theme', 'wp_boilerplate_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wp_boilerplate_content_width() {
    $GLOBALS['content_width'] = apply_filters('wp_boilerplate_content_width', 1200);
}
add_action('after_setup_theme', 'wp_boilerplate_content_width', 0);

/**
 * Register widget area.
 */
function wp_boilerplate_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'wp-boilerplate'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'wp-boilerplate'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-6 p-4 bg-white rounded shadow">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title text-lg font-semibold mb-3">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'wp-boilerplate'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'wp-boilerplate'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title text-lg font-semibold mb-3">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'wp-boilerplate'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'wp-boilerplate'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title text-lg font-semibold mb-3">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'wp-boilerplate'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'wp-boilerplate'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title text-lg font-semibold mb-3">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'wp-boilerplate'),
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'wp-boilerplate'),
        'before_widget' => '<section id="%1$s" class="widget %2$s mb-4">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title text-lg font-semibold mb-3">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'wp_boilerplate_widgets_init');