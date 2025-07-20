<?php
/**
 * Theme functions and definitions
 *
 * @package WP_Boilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('WP_BOILERPLATE_VERSION', '1.0.0');
define('WP_BOILERPLATE_DIR', trailingslashit(get_template_directory()));
define('WP_BOILERPLATE_URI', trailingslashit(get_template_directory_uri()));

// Include core files
require_once WP_BOILERPLATE_DIR . 'inc/setup.php';
require_once WP_BOILERPLATE_DIR . 'inc/assets.php'; 
require_once WP_BOILERPLATE_DIR . 'inc/template-functions.php';
require_once WP_BOILERPLATE_DIR . 'inc/customizer.php';
require_once WP_BOILERPLATE_DIR . 'inc/class-nav-walker.php';



// Optional: Include ACF support if the plugin is active
if (class_exists('ACF')) {
    require_once WP_BOILERPLATE_DIR . 'inc/acf-functions.php';
}

// Optional: Include WooCommerce support if the plugin is active
if (class_exists('WooCommerce')) {
    require_once WP_BOILERPLATE_DIR . 'inc/woocommerce.php';
}

/**
 * Adds the 'active' class to the current menu item for DaisyUI compatibility.
 */
function your_theme_name_add_active_class_to_menu_item($classes, $item) {
    if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'your_theme_name_add_active_class_to_menu_item', 10, 2);