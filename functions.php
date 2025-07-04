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
require_once WP_BOILERPLATE_DIR . 'inc/assets.php'; // We are keeping this one!
require_once WP_BOILERPLATE_DIR . 'inc/template-functions.php';
require_once WP_BOILERPLATE_DIR . 'inc/template-hooks.php';
require_once WP_BOILERPLATE_DIR . 'inc/customizer.php';

// Optional: Include ACF support if the plugin is active
if (class_exists('ACF')) {
    require_once WP_BOILERPLATE_DIR . 'inc/acf-functions.php';
}

// Optional: Include WooCommerce support if the plugin is active
if (class_exists('WooCommerce')) {
    require_once WP_BOILERPLATE_DIR . 'inc/woocommerce.php';
}



/**
 * Custom Nav Menu Walker
 * Controls the HTML output of the wp_nav_menu function.
 */
class Your_Theme_Name_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    private $is_mobile;

    function __construct($is_mobile = false) {
        $this->is_mobile = $is_mobile;
    }

    // This function is called for every top-level menu item
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $has_children = in_array('menu-item-has-children', $item->classes);

        if ($has_children) {
            // It's a dropdown item
            $output .= '<div class="relative" x-data="{ dropdownOpen: false }">';
            $output .= '<button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-1 px-3 py-2 rounded-md text-sm font-medium text-base-content hover:bg-base-200 focus:outline-none">';
            $output .= '<span>' . esc_html($item->title) . '</span>';
            $output .= '<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
            $output .= '</button>';
            $output .= '<div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-base-100 ring-1 ring-black ring-opacity-5 z-20" style="display: none;">';
            $output .= '<div class="py-1" role="menu" aria-orientation="vertical">';
        } else {
            // It's a regular link
            $output .= '<a href="' . esc_url($item->url) . '" class="px-3 py-2 rounded-md text-sm font-medium text-base-content hover:bg-base-200">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }

    // This is called when a top-level item with children is finished
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if (in_array('menu-item-has-children', $item->classes)) {
            $output .= '</div></div></div>'; // Close the dropdown divs
        }
    }

    // This function is called for sub-menu items
    public function start_lvl(&$output, $depth = 0, $args = null) {
        // We don't need to do anything here because start_el handles the wrapper
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        // We also don't need anything here
    }
}

// In functions.php

function wp_boilerplate_register_cpt_services() {
    $labels = array(
        'name'                  => _x( 'Services', 'Post type general name', 'wp-boilerplate' ),
        'singular_name'         => _x( 'Service', 'Post type singular name', 'wp-boilerplate' ),
        'menu_name'             => _x( 'Services', 'Admin Menu text', 'wp-boilerplate' ),
        'add_new_item'          => __( 'Add New Service', 'wp-boilerplate' ),
        'add_new'               => __( 'Add New', 'wp-boilerplate' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'service' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20, // Below 'Pages'
        'supports'           => array( 'title', 'editor', 'thumbnail' ), // We will use the Featured Image for the icon
        'menu_icon'          => 'dashicons-admin-tools',
    );
    register_post_type( 'service', $args );
}
add_action( 'init', 'wp_boilerplate_register_cpt_services' );

// In functions.php

function wp_boilerplate_register_cpt_testimonials() {
    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post type general name', 'wp-boilerplate' ),
        'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'wp-boilerplate' ),
        'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'wp-boilerplate' ),
        'add_new_item'          => __( 'Add New Testimonial', 'wp-boilerplate' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => false, // We don't need single pages for testimonials
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 21, // Below 'Services'
        'supports'           => array( 'title', 'editor' ), // Title will be author name, editor will be the quote
        'menu_icon'          => 'dashicons-format-quote',
    );
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'wp_boilerplate_register_cpt_testimonials' );