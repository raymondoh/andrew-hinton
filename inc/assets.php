<?php
/**
 * Enqueue scripts and styles for the theme.
 * This is the definitive version that correctly loads all libraries and localizes the main script.
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

    // Main stylesheet & Fancybox CSS
    wp_enqueue_style( 'main-stylesheet', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime( get_template_directory() . '/assets/css/main.css' ) );
    wp_enqueue_style( 'fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), '5.0' );
    
    // JAVASCRIPT LIBRARIES
    wp_enqueue_script( 'fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), '5.0', true );
    wp_enqueue_script( 'alpine-intersect-plugin', 'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js', array(), null, true );
    wp_enqueue_script( 'alpine-js', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array('alpine-intersect-plugin'), null, true );
    
    // Enqueue our theme's main JavaScript file
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array('fancybox-js', 'alpine-js'), filemtime( get_template_directory() . '/assets/js/main.js' ), true );

    // This is the crucial part: Localize the script, attaching our data directly to 'main-js'.
    wp_localize_script('main-js', 'hinton_portfolio_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('load_more_posts'),
    ));

}
add_action( 'wp_enqueue_scripts', 'art_portfolio_theme_enqueue_assets' );