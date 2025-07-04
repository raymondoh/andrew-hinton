<?php
/**
 * Theme Customizer
 *
 * @package WP_Boilerplate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_boilerplate_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector' => '.site-title a',
                'render_callback' => 'wp_boilerplate_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector' => '.site-description',
                'render_callback' => 'wp_boilerplate_customize_partial_blogdescription',
            )
        );
    }

    // Add Theme Options Panel
    $wp_customize->add_panel('wp_boilerplate_theme_options', array(
        'title' => __('Theme Options', 'wp-boilerplate'),
        'description' => __('Theme Options for WP Boilerplate', 'wp-boilerplate'),
        'priority' => 130,
    ));

    // Add Footer Section
    $wp_customize->add_section('wp_boilerplate_footer_options', array(
        'title' => __('Footer Options', 'wp-boilerplate'),
        'description' => __('Customize the footer', 'wp-boilerplate'),
        'panel' => 'wp_boilerplate_theme_options',
    ));

    // Add Footer Copyright Text
    $wp_customize->add_setting('wp_boilerplate_footer_copyright', array(
        'default' => __('All rights reserved.', 'wp-boilerplate'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('wp_boilerplate_footer_copyright', array(
        'label' => __('Copyright Text', 'wp-boilerplate'),
        'section' => 'wp_boilerplate_footer_options',
        'type' => 'text',
    ));

    // Add Social Media Section
    $wp_customize->add_section('wp_boilerplate_social_options', array(
        'title' => __('Social Media', 'wp-boilerplate'),
        'description' => __('Add your social media links', 'wp-boilerplate'),
        'panel' => 'wp_boilerplate_theme_options',
    ));

    // Add Facebook URL
    $wp_customize->add_setting('wp_boilerplate_facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('wp_boilerplate_facebook_url', array(
        'label' => __('Facebook URL', 'wp-boilerplate'),
        'section' => 'wp_boilerplate_social_options',
        'type' => 'url',
    ));

    // Add Twitter URL
    $wp_customize->add_setting('wp_boilerplate_twitter_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('wp_boilerplate_twitter_url', array(
        'label' => __('Twitter URL', 'wp-boilerplate'),
        'section' => 'wp_boilerplate_social_options',
        'type' => 'url',
    ));

    // Add Instagram URL
    $wp_customize->add_setting('wp_boilerplate_instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('wp_boilerplate_instagram_url', array(
        'label' => __('Instagram URL', 'wp-boilerplate'),
        'section' => 'wp_boilerplate_social_options',
        'type' => 'url',
    ));
}
add_action('customize_register', 'wp_boilerplate_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_boilerplate_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_boilerplate_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_boilerplate_customize_preview_js() {
    wp_enqueue_script('wp-boilerplate-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), WP_BOILERPLATE_VERSION, true);
}
add_action('customize_preview_init', 'wp_boilerplate_customize_preview_js');
