<?php
/**
 * Enqueue scripts and styles.
 */
function wp_boilerplate_assets() {
    // 1. Enqueue your theme's main stylesheet
    wp_enqueue_style(
        'wp-boilerplate-styles',
        get_template_directory_uri() . '/assets/css/main.css'
    );

    // 2. Enqueue Fancybox CSS from its CDN
    wp_enqueue_style(
        'fancybox-css',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css'
    );

    // 3. Enqueue the Alpine Intersect Plugin (for fade-in animations)
    wp_enqueue_script(
        'alpine-intersect-plugin',
        'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js',
        [], null, true
    );
    
    // 4. Enqueue the core Alpine.js library
    wp_enqueue_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
        [], null, true
    );

    // 5. Enqueue Fancybox JavaScript from its CDN
    wp_enqueue_script(
        'fancybox-js',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js',
        [], null, true
    );

    // 6. Enqueue our custom JavaScript file to initialize everything
    wp_enqueue_script(
        'theme-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        ['fancybox-js'], // Make sure Fancybox loads first
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'wp_boilerplate_assets' );