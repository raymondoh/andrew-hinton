<?php
/**
 * The template for displaying all single posts
 *
 * @package WP_Boilerplate
 */

get_header();
?>

<div class="container mx-auto my-12 px-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <main id="main" class="site-main lg:col-span-2">
            <?php
            // Start the Loop.
            while ( have_posts() ) :
                the_post();

                // Get the template part for displaying single post content.
                get_template_part( 'template-parts/content/content-single' );

                // If comments are open or we have at least one comment, load up the comment template.
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