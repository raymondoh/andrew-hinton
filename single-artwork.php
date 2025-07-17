<?php
/**
 * The template for displaying a single artwork post.
 * This version now uses conditional logic to display a unique layout for videos.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); ?>

<div class="container mx-auto px-4 py-16">

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-6xl mx-auto'); ?>>

        <?php
            // Check if the current post is in the 'Film & Video' medium category.
            // Be sure the slug 'film-video' matches what you have in WP Admin > Artworks > Mediums.
            if ( has_term( 'film-video', 'medium' ) ) : 
            ?>

        <div class="video-layout max-w-xl mx-auto">
            <?php 
                    $artwork_year = get_field('year_created'); 
                    if ( $artwork_year ) : 
                    ?>
            <p class="text-lg text-base-content/60 mb-2"><?php echo esc_html( $artwork_year ); ?></p>
            <?php endif; ?>

            <header class="entry-header mb-8">
                <?php the_title( '<h1 class="entry-title text-4xl font-bold text-base-content leading-tight">', '</h1>' ); ?>
            </header>

            <div class="entry-content aspect-video">
                <?php the_content(); ?>
            </div>
        </div>

        <?php else : ?>

        <div class="static-layout flex flex-col md:flex-row md:gap-x-12 lg:gap-x-16">

            <div class="md:w-1/2 mb-8 md:mb-0">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="shadow-lg">
                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
                </div>
                <?php endif; ?>
            </div>

            <div class="md:w-1/2">
                <?php 
                        $artwork_year = get_field('year_created'); 
                        if ( $artwork_year ) : 
                        ?>
                <p class="text-lg text-base-content/60 mb-2"><?php echo esc_html( $artwork_year ); ?></p>
                <?php endif; ?>

                <header class="entry-header mb-6">
                    <?php the_title( '<h1 class="entry-title text-4xl font-bold text-base-content leading-tight">', '</h1>' ); ?>
                </header>

                <div class="entry-content prose max-w-none text-base-content/90">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

        <?php endif; // End of the has_term() check ?>

    </article>

    <?php endwhile; // End of the loop. ?>

</div>

<?php get_footer(); ?>