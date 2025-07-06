<?php
/**
 * Custom Nav Menu Walker
 * Controls the HTML output of the wp_nav_menu function.
 */
class Your_Theme_Name_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    private $is_mobile;

    function __construct($is_mobile = false) {
        $this->is_mobile = $is_mobile;
    }

    // This function is called for every top-level menu item
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $has_children = in_array('menu-item-has-children', $item->classes);

        if ($has_children) {
            // It's a dropdown item
            $output .= '<div class="relative" x-data="{ dropdownOpen: false }">';
            $output .= '<button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-1 px-3 py-2 rounded-md text-sm font-medium text-base-content hover:bg-base-200 focus:outline-none">';
            $output .= '<span>' . esc_html($item->title) . '</span>';
            $output .= '<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
            $output .= '</button>';
            $output .= '<div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-base-100 ring-1 ring-black ring-opacity-5 z-20" style="display: none;">';
            $output .= '<div class="py-1" role="menu" aria-orientation="vertical">';
        } else {
            // It's a regular link
            $output .= '<a href="' . esc_url($item->url) . '" class="px-3 py-2 rounded-md text-sm font-medium text-base-content hover:bg-base-200">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }

    // This is called when a top-level item with children is finished
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if (in_array('menu-item-has-children', $item->classes)) {
            $output .= '</div></div></div>'; // Close the dropdown divs
        }
    }

    // This function is called for sub-menu items
    public function start_lvl(&$output, $depth = 0, $args = null) {
        // We don't need to do anything here because start_el handles the wrapper
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        // We also don't need anything here
    }
}