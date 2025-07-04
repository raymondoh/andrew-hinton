<?php
/**
 * WooCommerce Compatibility File
 *
 * @package WP_Boilerplate
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * WooCommerce setup function.
 */
function wp_boilerplate_woocommerce_setup() {
    // Add theme support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'wp_boilerplate_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 */
function wp_boilerplate_woocommerce_scripts() {
    // Enqueue WooCommerce styles
    wp_enqueue_style('wp-boilerplate-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), WP_BOILERPLATE_VERSION);
}
add_action('wp_enqueue_scripts', 'wp_boilerplate_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function wp_boilerplate_woocommerce_active_body_class($classes) {
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter('body_class', 'wp_boilerplate_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function wp_boilerplate_woocommerce_related_products_args($args) {
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'wp_boilerplate_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add custom WooCommerce wrapper.
 */
function wp_boilerplate_woocommerce_wrapper_before() {
    ?>
    <main id="primary" class="site-main container mx-auto py-8 px-4">
    <?php
}
add_action('woocommerce_before_main_content', 'wp_boilerplate_woocommerce_wrapper_before');

/**
 * Add custom WooCommerce wrapper end.
 */
function wp_boilerplate_woocommerce_wrapper_after() {
    ?>
    </main>
    <?php
}
add_action('woocommerce_after_main_content', 'wp_boilerplate_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 */
function wp_boilerplate_woocommerce_cart_link() {
    ?>
    <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'wp-boilerplate'); ?>">
        <?php
        $item_count_text = sprintf(
            /* translators: number of items in the mini cart. */
            _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'wp-boilerplate'),
            WC()->cart->get_cart_contents_count()
        );
        ?>
        <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo esc_html($item_count_text); ?></span>
    </a>
    <?php
}

/**
 * Cart Fragments.
 *
 * Ensure cart contents update when products are added to the cart via AJAX.
 *
 * @param array $fragments Fragments to refresh via AJAX.
 * @return array Fragments to refresh via AJAX.
 */
function wp_boilerplate_woocommerce_cart_link_fragment($fragments) {
    ob_start();
    wp_boilerplate_woocommerce_cart_link();
    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'wp_boilerplate_woocommerce_cart_link_fragment');
