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
 * Custom Nav Walker for the Desktop Menu
 *
 * This class applies dynamic Tailwind CSS and Alpine.js classes to the desktop menu items,
 * allowing them to change color on scroll and indicating the active page with a styled underline.
 */
class Andrew_Hinton_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        
        $is_active = in_array( 'current-menu-item', $item->classes ) || in_array( 'current_page_item', $item->classes );
        
        $static_classes = 'font-medium transition-all duration-300';
        
        // Conditionally add classes for the active/inactive state.
        if ( $is_active ) {
            // THE FIX: Added underline-offset-4 to push the line down.
            $static_classes .= ' underline underline-offset-4'; 
        } else {
            // Inactive links get 'no-underline' and are faded.
            $static_classes .= ' no-underline opacity-75 hover:opacity-100'; 
        }

        // Determine the dynamic color classes.
        $dynamic_classes_string = '';
        if ( in_array('has-light-background', get_body_class()) ) {
            // On light pages: start dark, turn light on scroll.
            $dynamic_classes_string = ":class=\"{ 'text-dark': atTop, 'text-light': !atTop }\"";
        } else {
            // On dark/hero pages: always stay light.
            $static_classes .= ' text-light';
        }

        // Print the final link with separate static and dynamic class attributes.
        $output .= sprintf(
            '<a href="%s" class="%s" %s>%s</a>',
            esc_url( $item->url ),
            esc_attr($static_classes),
            $dynamic_classes_string, // This contains the :class="..." directive
            esc_html( $item->title )
        );
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_lvl( &$output, $depth = 0, $args = array() ) {}
    function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {}
}



/**
 * Custom Nav Walker for the Mobile Menu
 *
 * This class applies custom Tailwind CSS classes to the mobile menu items,
 * restoring the active/inactive states and adding vertical spacing.
 */
class Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        
        $is_active = in_array( 'current-menu-item', $item->classes ) || in_array( 'current_page_item', $item->classes );

        // Add a bottom margin to each link for spacing
        $class_string = 'block px-3 py-3 rounded-md text-base font-medium transition-colors duration-200 mb-2';

        if ( $is_active ) {
            $class_string .= ' bg-light text-dark'; // Active state
        } else {
            $class_string .= ' text-light hover:bg-support'; // Inactive state
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