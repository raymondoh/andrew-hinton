<?php
/**
 * Enqueue scripts and styles for the theme.
 * Final version ensuring all libraries (Fancybox, Alpine.js) are loaded correctly.
 *
 * @package Art_Portfolio_Theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles.
 */
function art_portfolio_theme_enqueue_assets() {

    // Main stylesheet - compiled from Tailwind CSS
    wp_enqueue_style(
        'main-stylesheet',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );

    // Enqueue Fancybox CSS from its CDN
    wp_enqueue_style( 
        'fancybox-css', 
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', 
        array(), 
        '5.0' 
    );
    
    // --- JAVASCRIPT LIBRARIES ---

    // 1. Enqueue Fancybox JavaScript from its CDN
    wp_enqueue_script( 
        'fancybox-js', 
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', 
        array(), 
        '5.0', 
        true // Load in the footer
    );

    // 2. Enqueue the Alpine.js Intersect Plugin (for fade-in animations)
    wp_enqueue_script(
        'alpine-intersect-plugin',
        'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js',
        array(), // No dependencies
        null,
        true // Load in the footer
    );

    // 3. Enqueue the core Alpine.js library, and make it depend on the Intersect plugin
    wp_enqueue_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
        array('alpine-intersect-plugin'), // Depends on the intersect plugin
        null,
        true // Load in the footer
    );
    
    // 4. Enqueue our theme's main JavaScript file
    // Make it dependent on both Fancybox and Alpine.js to ensure they load first.
    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array('fancybox-js', 'alpine-js'), // Now depends on both libraries
        filemtime( get_template_directory() . '/assets/js/main.js' ),
        true // Load in the footer
    );

    // Localize script to pass AJAX URL and nonce to our main.js
    wp_localize_script('main-js', 'my_theme_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('load_more_posts'),
    ));

}
add_action( 'wp_enqueue_scripts', 'art_portfolio_theme_enqueue_assets' );