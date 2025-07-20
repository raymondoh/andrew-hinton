<?php
/**
 * The template for displaying all single posts (e.g., a single Journal entry).
 * This version adds vertical padding for a consistent layout.
 *
 * @package Art_Portfolio_Theme
 */

get_header();
?>

<!-- MODIFICATION: Added vertical padding (py-16) to the main container -->
<div class="container mx-auto px-4 py-16">
    <div class="fade-in-element" x-data="{ inView: false }" x-intersect:enter="inView = true"
        :class="{ 'is-visible': inView }">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="site-main lg:col-span-2">
                <?php
                // Start the Loop.
                while ( have_posts() ) :
                    the_post();

                    // This gets the template part for displaying the post's content.
                    get_template_part( 'template-parts/content/content-single' );

                    // If comments are open, load the comment template.
                    // if ( comments_open() || get_comments_number() ) :
                    //     comments_template();
                    // endif;

                endwhile; // End of the loop.
                ?>
            </div>

            <aside id="secondary" class="widget-area">
                <?php get_sidebar(); ?>
            </aside>

        </div>
    </div>
</div>

<?php
get_footer();