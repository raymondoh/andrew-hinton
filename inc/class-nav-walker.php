<?php
/**
 * Custom navigation walkers.
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Desktop navigation walker
 */
class Andrew_Hinton_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     *
     * @param string $output            Used to append additional content (passed by reference).
     * @param WP_Post $item             Menu item data object.
     * @param int $depth                Depth of menu item. Used for padding.
     * @param stdClass $args            An object of wp_nav_menu() arguments.
     * @param int $id                   Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $li_attributes = '';
        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        // This is where we add the 'active' class for DaisyUI compatibility.
        // This relies on the filter you previously added to functions.php
        if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
            $classes[] = 'active';
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . ' menu-item"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names . $li_attributes . '>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        // All styling is now handled by this single, clean class for the hover underline effect.
        $attributes .= ' class="desktop-nav-link"'; 

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
/**
 * Mobile navigation walker
 */
/**
 * A simple Nav Walker to output clean links for the mobile menu.
 * This version now correctly handles the active and inactive link states.
 */
class Mobile_Nav_Walker extends Walker_Nav_Menu {
    // This function controls how each menu item is output
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        
        // Check if the current item is the active page
        $is_active = in_array( 'current-menu-item', $item->classes ) || in_array( 'current_page_item', $item->classes );

        // Start with the base classes for all links
        $class_string = 'block px-3 py-3 rounded-md text-base font-medium transition-colors duration-200';

        // Conditionally add classes for active vs. inactive states
        if ( $is_active ) {
            $class_string .= ' bg-light text-dark'; // Active state: light bg, dark text
        } else {
            $class_string .= ' text-light hover:bg-support'; // Inactive state: light text, darker bg on hover
        }

        // Output the final link with the correct classes
        $output .= sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url( $item->url ),
            esc_attr( $class_string ),
            esc_html( $item->title )
        );
    }

    // These functions are needed to stop WordPress from adding extra <ul> and <li> tags
    function start_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {}
}