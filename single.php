<?php
/**
 * The template for displaying all single posts
 *
 * @package WP_Boilerplate
 */

get_header();
?>

<div class="container mx-auto site-content px-4 pt-28 pb-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <main id="main" class="site-main lg:col-span-2">
            <?php
            // Start the standard WordPress Loop.
            while ( have_posts() ) :
                the_post();

                // Get the template part for displaying single post content.
                // We will create this file in the next step.
                get_template_part( 'template-parts/content/content-single' );

                // If comments are open or there is at least one comment, load the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </main>
        <aside id="secondary" class="widget-area">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php
get_footer();