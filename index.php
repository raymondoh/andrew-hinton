<?php
/**
 * The main template file for displaying the blog archive.
 *
 * @package WP_Boilerplate
 */

get_header(); ?>

<div class="container mx-auto my-12 px-4">
    <header class="page-header mb-12 text-center">
        <h1 class="text-5xl font-bold">From the Blog</h1>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <main id="main" class="site-main lg:col-span-2">

            <?php if ( have_posts() ) : ?>

            <div class="space-y-12">
                <?php
                // Start the Loop.
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * We will create this file in the next step.
                     */
                    get_template_part( 'template-parts/content/content', get_post_format() );

                // End the loop.
                endwhile;
                ?>
            </div>
            <?php
                // Previous/next page navigation.
                the_posts_pagination( array(
                    'prev_text' => __( '&laquo; Previous', 'wp-boilerplate' ),
                    'next_text' => __( 'Next &raquo;', 'wp-boilerplate' ),
                    'screen_reader_text' => ' ', // Hides the screen reader text for a cleaner look
                    'before_page_number' => '<span class="btn btn-ghost">',
                    'after_page_number'  => '</span>',
                ) );

            else :
                // If no content, include the "No posts found" template.
                get_template_part( 'template-parts/content/content-none' );

            endif;
            ?>
        </main>
        <aside id="secondary" class="widget-area">
            <?php get_sidebar(); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>