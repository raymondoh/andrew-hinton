<?php
/**
 * Andrew Hinton Portfolio Theme functions and definitions.
 *
 * @package Hinton_Portfolio_Theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// -----------------------------------------------------------------------------
// 1. CONSTANTS & SETUP
// -----------------------------------------------------------------------------

define( 'HINTON_PORTFOLIO_VERSION', '1.0.2' );
define( 'HINTON_PORTFOLIO_DIR', trailingslashit( get_template_directory() ) );
define( 'HINTON_PORTFOLIO_URI', trailingslashit( get_template_directory_uri() ) );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function hinton_portfolio_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'hinton-portfolio' ),
    ) );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    add_theme_support( 'align-wide' );
    
    // THE FIX: Enable support for responsive embedded content (like YouTube videos).
    add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'hinton_portfolio_setup' );

// -----------------------------------------------------------------------------
// 2. ENQUEUE SCRIPTS & STYLES
// -----------------------------------------------------------------------------

/**
 * Enqueue scripts and styles.
 */
function hinton_portfolio_enqueue_assets() {
    wp_enqueue_style( 'hinton-portfolio-main-style', HINTON_PORTFOLIO_URI . 'assets/css/main.css', array(), filemtime( HINTON_PORTFOLIO_DIR . 'assets/css/main.css' ) );
    wp_enqueue_style( 'fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), '5.0' );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Lora:ital,wght@0,400;0,700;1,400&display=swap', array(), null );

    wp_enqueue_script( 'fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array(), '5.0', true );
    wp_enqueue_script( 'alpine-intersect-plugin', 'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js', array(), null, true );
    wp_enqueue_script( 'alpine-js', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array( 'alpine-intersect-plugin' ), null, true );
    wp_enqueue_script( 'hinton-portfolio-main-js', HINTON_PORTFOLIO_URI . 'assets/js/main.js', array( 'fancybox-js', 'alpine-js' ), filemtime( HINTON_PORTFOLIO_DIR . 'assets/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'hinton_portfolio_enqueue_assets' );

/**
 * Prints the AJAX data object directly into the HTML <head>.
 */
function hinton_portfolio_print_ajax_object() {
    $ajax_data = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'load_more_posts' ),
    );
    ?>
<script>
const hinton_portfolio_ajax_obj = <?php echo json_encode( $ajax_data ); ?>;
</script>
<?php
}
add_action( 'wp_head', 'hinton_portfolio_print_ajax_object' );

// -----------------------------------------------------------------------------
// 3. HELPER FUNCTIONS & TEMPLATE TAGS
// -----------------------------------------------------------------------------

/**
 * Adds custom classes to the array of body classes.
 */
function hinton_portfolio_body_classes( $classes ) {
    if ( is_front_page() || is_page_template( 'template-artist-statement.php' ) || is_singular( 'artwork' ) || is_home() || is_single() ) {
        $classes[] = 'has-light-background';
    }
    return $classes;
}
add_filter( 'body_class', 'hinton_portfolio_body_classes' );

/**
 * Register all custom image sizes for the theme.
 */
function hinton_portfolio_custom_image_sizes() {
    add_image_size( 'portfolio-thumb', 600, 600, true );
    add_image_size( 'mosaic-large', 1200, 800, true );
    add_image_size( 'mosaic-small', 600, 400, true );
    add_image_size( 'artist-photo', 800, 9999 );
    add_image_size( 'journal-thumb', 400, 400, true );
}
add_action( 'after_setup_theme', 'hinton_portfolio_custom_image_sizes' );

// -----------------------------------------------------------------------------
// 4. CUSTOM NAVIGATION WALKERS
// -----------------------------------------------------------------------------

/**
 * Custom Nav Walker for the Desktop Menu
 */
class Andrew_Hinton_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $is_active = in_array( 'current-menu-item', $item->classes ) || in_array( 'current_page_item', $item->classes );
        $static_classes = 'font-medium transition-all duration-300';
        if ( $is_active ) {
            $static_classes .= ' underline underline-offset-4';
        } else {
            $static_classes .= ' no-underline opacity-75 hover:opacity-100';
        }
        $dynamic_classes_string = '';
        if ( in_array('has-light-background', get_body_class()) ) {
            $dynamic_classes_string = ":class=\"{ 'text-dark': atTop, 'text-light': !atTop }\"";
        } else {
            $static_classes .= ' text-light';
        }
        $output .= sprintf(
            '<a href="%s" class="%s" %s>%s</a>',
            esc_url( $item->url ),
            esc_attr($static_classes),
            $dynamic_classes_string,
            esc_html( $item->title )
        );
    }
    function start_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {}
}

/**
 * Custom Nav Walker for the Mobile Menu
 */
class Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $is_active = in_array( 'current-menu-item', $item->classes ) || in_array( 'current_page_item', $item->classes );
        $class_string = 'block px-3 py-3 rounded-md text-base font-medium transition-colors duration-200 mb-2';
        if ( $is_active ) {
            $class_string .= ' bg-light text-dark';
        } else {
            $class_string .= ' text-light hover:bg-support';
        }
        $output .= sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url( $item->url ),
            esc_attr( $class_string ),
            esc_html( $item->title )
        );
    }
    function start_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {}
}
/**
 * Adds responsive classes to embedded iframes.
 *
 * This function targets oEmbeds (like YouTube) and adds Tailwind classes
 * to make them fill their parent container.
 *
 * @param string $html The HTML of the embed.
 * @return string The modified HTML.
 */
function hinton_portfolio_responsive_embeds( $html ) {
    return str_replace( '<iframe', '<iframe class="absolute top-0 left-0 w-full h-full"', $html );
}
add_filter( 'embed_oembed_html', 'hinton_portfolio_responsive_embeds', 10, 1 );