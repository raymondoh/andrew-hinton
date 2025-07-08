<?php
/**
 * The main template file for displaying the blog archive (Journal).
 *
 * @package Art_Portfolio_Theme
 */

get_header(); ?>

<div class="container mx-auto px-4">
    <div class="fade-in-element" x-data="{ inView: false }" x-intersect:enter="inView = true"
        :class="{ 'is-visible': inView }">
        <header class="page-header mb-12 text-center">
            <h1 class="text-2xl font-bold"><?php single_post_title(); ?></h1>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="site-main lg:col-span-2">

                <?php if ( have_posts() ) : ?>

                <div class="space-y-12">
                    <?php
                    // Start the Loop to display each post summary.
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/content/content', get_post_format() );
                    endwhile;
                    ?>
                </div>

                <?php
                    // Display pagination if there are more posts than can fit on one page.
                    the_posts_pagination( array(
                        'prev_text' => __( '&laquo; Previous', 'wp-boilerplate' ),
                        'next_text' => __( 'Next &raquo;', 'wp-boilerplate' ),
                        'screen_reader_text' => ' ',
                        'before_page_number' => '<span class="btn btn-ghost">',
                        'after_page_number'  => '</span>',
                    ) );

                else :
                    // If no posts are found, display a "not found" message.
                    get_template_part( 'template-parts/content/content-none' );

                endif;
                ?>
            </div>

            <aside id="secondary" class="widget-area">
                <?php get_sidebar(); ?>
            </aside>

        </div>
    </div>
</div>

<?php get_footer(); ?>