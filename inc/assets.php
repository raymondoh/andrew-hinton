<?php
/**
 * Enqueue scripts and styles.
 */
function wp_boilerplate_assets() {
    // 1. Enqueue your compiled stylesheet
    wp_enqueue_style(
        'wp-boilerplate-styles',
        get_template_directory_uri() . '/assets/css/main.css'
    );

    // 2. Enqueue Swiper.js CSS from a CDN
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'
    );

    // 3. Enqueue Alpine.js from a CDN
    wp_enqueue_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js', // Specific version
        [],
        null,
        true
    );

    // 4. Enqueue Swiper.js script from a CDN
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        null,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'wp_boilerplate_assets' );