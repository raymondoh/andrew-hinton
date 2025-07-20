<?php
/**
 * The template for displaying a single artwork post.
 * This definitive version provides a consistent, detailed layout for all media types.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); ?>

<div class="container mx-auto px-4 py-16">

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-6xl mx-auto'); ?>>

        <?php
            // Check if the current post is in the 'Film & Video' medium category.
            if ( has_term( 'film-video', 'medium' ) ) : 
            ?>

        <!-- Layout for Film & Video -->
        <div class="video-layout max-w-3xl mx-auto">
            <header class="entry-header mb-4">
                <?php the_title( '<h1 class="entry-title text-4xl lg:text-5xl font-bold text-base-content leading-tight">', '</h1>' ); ?>
            </header>

            <!-- Meta Details: Year and Dimensions -->
            <div class="artwork-meta text-lg text-base-content/60 mb-8">
                <?php 
                $artwork_year = get_field('artwork_year');
                if ( $artwork_year ) :
                ?>
                <span><?php echo esc_html( $artwork_year ); ?></span>
                <?php endif; ?>

                <?php
                $artwork_dimensions = get_field('artwork_dimensions');
                if ( $artwork_year && $artwork_dimensions ) {
                    echo '<span class="mx-2">&middot;</span>'; // Separator
                }
                if ( $artwork_dimensions ) :
                ?>
                <span><?php echo esc_html( $artwork_dimensions ); ?></span>
                <?php endif; ?>
            </div>

            <!-- Video Player -->
            <div class="entry-content aspect-video bg-black rounded-lg overflow-hidden shadow-lg mb-8">
                <?php the_content(); // This is where the YouTube/Vimeo embed code goes ?>
            </div>

            <!-- Artwork Description -->
            <div class="entry-description prose max-w-none text-base-content/90">
                <?php
                $artwork_description = get_field('artwork_description');
                if ( $artwork_description ) {
                    echo wp_kses_post( $artwork_description );
                }
                ?>
            </div>
        </div>

        <?php else : ?>

        <!-- Layout for Static Artwork (Images) -->
        <div class="static-layout flex flex-col md:flex-row md:gap-x-12 lg:gap-x-20">

            <!-- Left Column: Image -->
            <div class="md:w-1/2 lg:w-3/5 mb-8 md:mb-0">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="shadow-lg  overflow-hidden">
                    <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Details -->
            <div class="md:w-1/2 lg:w-2/5">
                <header class="entry-header mb-4">
                    <?php the_title( '<h1 class="entry-title text-4xl lg:text-5xl font-bold text-base-content leading-tight">', '</h1>' ); ?>
                </header>

                <!-- Meta Details: Year and Dimensions -->
                <div class="artwork-meta text-lg text-base-content/60 mb-8">
                    <?php 
                    $artwork_year = get_field('artwork_year');
                    if ( $artwork_year ) :
                    ?>
                    <span><?php echo esc_html( $artwork_year ); ?></span>
                    <?php endif; ?>

                    <?php
                    $artwork_dimensions = get_field('artwork_dimensions');
                    if ( $artwork_year && $artwork_dimensions ) {
                        echo '<span class="mx-2">&middot;</span>'; // Separator
                    }
                    if ( $artwork_dimensions ) :
                    ?>
                    <span><?php echo esc_html( $artwork_dimensions ); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Artwork Description -->
                <div class="entry-content prose max-w-none text-base-content/90">
                    <?php
                    $artwork_description = get_field('artwork_description');
                    if ( $artwork_description ) {
                        echo wp_kses_post( $artwork_description );
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php endif; // End of the has_term() check ?>

    </article>

    <?php endwhile; // End of the loop. ?>

</div>

<?php get_footer(); ?>