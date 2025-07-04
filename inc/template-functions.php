<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WP_Boilerplate
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_boilerplate_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'wp_boilerplate_pingback_header');

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wp_boilerplate_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'wp_boilerplate_body_classes');

/**
 * Add a custom excerpt length
 */
function wp_boilerplate_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'wp_boilerplate_excerpt_length');

/**
 * Change the excerpt more string
 */
function wp_boilerplate_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'wp_boilerplate_excerpt_more');

/**
 * Disable Gutenberg editor for specific post types
 */
function wp_boilerplate_disable_gutenberg($current_status, $post_type) {
    // Add post types where you want to disable Gutenberg
    $disabled_post_types = array('');

    if (in_array($post_type, $disabled_post_types)) {
        return false;
    }

    return $current_status;
}
add_filter('use_block_editor_for_post_type', 'wp_boilerplate_disable_gutenberg', 10, 2);

/**
 * Add custom image sizes
 */
function wp_boilerplate_add_image_sizes() {
    add_image_size('featured-large', 1200, 600, true);
    add_image_size('featured-medium', 800, 400, true);
    add_image_size('featured-small', 400, 200, true);
}
add_action('after_setup_theme', 'wp_boilerplate_add_image_sizes');

/**
 * Make custom image sizes available in the media library
 */
function wp_boilerplate_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'featured-large' => __('Featured Large', 'wp-boilerplate'),
        'featured-medium' => __('Featured Medium', 'wp-boilerplate'),
        'featured-small' => __('Featured Small', 'wp-boilerplate'),
    ));
}
add_filter('image_size_names_choose', 'wp_boilerplate_custom_image_sizes');
