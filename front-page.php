<?php
/**
 * The template for the front page.
 * This final version correctly centers the content with appropriate spacing.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); ?>

<div class="front-page-content min-h-screen flex items-center justify-center w-full py-16 md:py-18">
    <?php
    // We include the single mosaic component file
    get_template_part('template-parts/page/front-page-mosiac');
    ?>
</div>

<?php get_footer(); ?>