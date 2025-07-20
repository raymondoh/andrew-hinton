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

    // THE wp_localize_script CALL HAS BEEN REMOVED FROM HERE TO PREVENT CONFLICTS

}
add_action( 'wp_enqueue_scripts', 'art_portfolio_theme_enqueue_assets' );


/**
 * --- THIS IS THE DEFINITIVE FIX ---
 * Prints the AJAX data object directly into the HTML <head>.
 * This makes it globally available before any other scripts run, eliminating race conditions.
 */
function hinton_portfolio_print_ajax_object() {
    $ajax_data = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('load_more_posts'),
    );
    ?>
<script>
const hinton_portfolio_ajax_obj = <?php echo json_encode($ajax_data); ?>;
</script>
<?php
}
add_action('wp_head', 'hinton_portfolio_print_ajax_object');

/**
 * Adds custom classes to the array of body classes.
 *
 * This function adds a 'has-light-background' class to pages
 * that do not have a hero image, allowing the header text to be styled differently.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * This function adds a 'has-light-background' class to pages
 * that do not have a hero image, allowing the header text to be styled differently.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function art_portfolio_theme_body_classes( $classes ) {
    // Add the class to the front page, statement page, single artworks, blog page, and single blog posts.
    if ( is_front_page() || is_page_template('template-artist-statement.php') || is_singular('artwork') || is_home() || is_single() ) {
        $classes[] = 'has-light-background';
    }
    return $classes;
}
add_filter( 'body_class', 'art_portfolio_theme_body_classes' );