<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage your-theme-name
 */

get_header();

// Check if we are on the front page.
if ( is_front_page() ) {
    // If we are, load the front-page.php template file.
    get_template_part('front-page');
} else {
    // Otherwise, this is a regular page, so show its content.
    while ( have_posts() ) :
        the_post();
        ?>
<div class="container mx-auto my-8">
    <h1 class="text-4xl font-bold"><?php the_title(); ?></h1>
    <div class="prose lg:prose-xl mt-4">
        <?php the_content(); ?>
    </div>
</div>
<?php
    endwhile;
}

get_footer();