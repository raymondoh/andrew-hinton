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
class Your_Theme_Name_Walker_Nav_Menu extends Walker_Nav_Menu {
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
class Mobile_Nav_Walker extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        // Add active class
        if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
            $classes[] = 'active';
        }

        $class_string = 'block px-4 py-2 text-base';
        if (in_array('active', $classes)) {
            $class_string .= ' bg-base-300 text-base-content';
        } else {
            $class_string .= ' text-base-content hover:bg-base-200';
        }

        // Add the 'uppercase' class here for mobile menu
        $class_string .= ' uppercase';

        $output .= '<a href="' . esc_url($item->url) . '" class="' . esc_attr($class_string) . '">';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '</a>';
    }

    /**
     * Do not start a new level.
     */
    function start_lvl( &$output, $depth = 0, $args = null ) {}

    /**
     * Do not end a level.
     */
    function end_lvl( &$output, $depth = 0, $args = null ) {}

    /**
     * Do not end an element.
     */
    function end_el( &$output, $item, $depth = 0, $args = null ) {}
}