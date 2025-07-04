<?php
/**
 * ACF related functions
 *
 * @package WP_Boilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF Blocks
 */
function wp_boilerplate_register_acf_blocks() {
    // Check if ACF Pro is active
    if (function_exists('acf_register_block_type')) {
        // Register a hero block
        acf_register_block_type(array(
            'name'              => 'hero',
            'title'             => __('Hero', 'wp-boilerplate'),
            'description'       => __('A custom hero block.', 'wp-boilerplate'),
            'render_template'   => 'template-parts/blocks/hero/hero.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('hero', 'banner'),
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/hero/hero.css',
            'enqueue_script'    => get_template_directory_uri() . '/template-parts/blocks/hero/hero.js',
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
                'jsx' => true,
            ),
        ));

        // Register a testimonial block
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial', 'wp-boilerplate'),
            'description'       => __('A custom testimonial block.', 'wp-boilerplate'),
            'render_template'   => 'template-parts/blocks/testimonial/testimonial.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array('testimonial', 'quote'),
            'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/testimonial/testimonial.css',
            'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                'mode' => false,
            ),
        ));
    }
}
add_action('acf/init', 'wp_boilerplate_register_acf_blocks');

/**
 * Register ACF Options Pages
 */
function wp_boilerplate_register_acf_options_pages() {
    // Check if function exists
    if (function_exists('acf_add_options_page')) {
        // Add parent options page
        acf_add_options_page(array(
            'page_title'    => __('Theme Settings', 'wp-boilerplate'),
            'menu_title'    => __('Theme Settings', 'wp-boilerplate'),
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => true,
        ));

        // Add sub options page
        acf_add_options_sub_page(array(
            'page_title'    => __('Header Settings', 'wp-boilerplate'),
            'menu_title'    => __('Header', 'wp-boilerplate'),
            'parent_slug'   => 'theme-general-settings',
        ));

        // Add sub options page
        acf_add_options_sub_page(array(
            'page_title'    => __('Footer Settings', 'wp-boilerplate'),
            'menu_title'    => __('Footer', 'wp-boilerplate'),
            'parent_slug'   => 'theme-general-settings',
        ));
    }
}
add_action('acf/init', 'wp_boilerplate_register_acf_options_pages');
