<?php
/**
 * Template Name: Blank Page
 *
 * This template is used for displaying a page without the header, footer, or sidebar.
 * It's ideal for embedding content via an iframe.
 *
 * @package Art_Portfolio_Theme
 */

// This hook is essential. It allows plugins to add their CSS and other necessary code to the <head>.
wp_head();

// The standard WordPress loop. It will find your page's content (the shortcode) and display it.
while ( have_posts() ) : the_post();
    the_content();
endwhile;

// This hook is also essential. It allows plugins to add their JavaScript files before the </body> tag.
wp_footer();