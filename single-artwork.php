<?php
/**
 * The template for displaying a single artwork post.
 * This version removes the rounded corners from the main featured image.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); ?>

<div class="container mx-auto px-4 py-16">

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-6xl mx-auto'); ?>>

        <?php
            if ( has_term( 'film-video', 'medium' ) ) : 
            ?>

        <!-- Layout for Film & Video (keeps rounded corners) -->
        <div class="video-layout max-w-3xl mx-auto">
            <header class="entry-header mb-4">
                <?php the_title( '<h1 class="entry-title text-4xl lg:text-5xl font-bold text-base-content leading-tight">', '</h1>' ); ?>
            </header>
            <div class="artwork-meta text-lg text-base-content/60 mb-8">
                <?php 
                $artwork_year = get_field('artwork_year');
                if ( $artwork_year ) : ?>
                <span><?php echo esc_html( $artwork_year ); ?></span>
                <?php endif; ?>
                <?php
                $artwork_dimensions = get_field('artwork_dimensions');
                if ( $artwork_year && $artwork_dimensions ) {
                    echo '<span class="mx-2">&middot;</span>';
                }
                if ( $artwork_dimensions ) : ?>
                <span><?php echo esc_html( $artwork_dimensions ); ?></span>
                <?php endif; ?>
            </div>
            <div class="entry-content relative aspect-video bg-black rounded-lg overflow-hidden shadow-lg mb-8">
                <?php the_content(); ?>
            </div>
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
        <div class="static-layout">
            <div class="flex flex-col md:flex-row md:gap-x-12 lg:gap-x-20">
                <!-- Left Column: Image -->
                <div class="md:w-1/2 lg:w-3/5 mb-8 md:mb-0">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <!-- MODIFICATION: Removed 'rounded-lg' from this container -->
                    <div class="shadow-lg overflow-hidden">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Right Column: Details -->
                <div class="md:w-1/2 lg:w-2/5">
                    <header class="entry-header mb-4">
                        <?php the_title( '<h1 class="entry-title text-4xl lg:text-5xl font-bold text-base-content leading-tight">', '</h1>' ); ?>
                    </header>
                    <div class="artwork-meta text-lg text-base-content/60 mb-8">
                        <?php 
                        $artwork_year = get_field('artwork_year');
                        if ( $artwork_year ) : ?>
                        <span><?php echo esc_html( $artwork_year ); ?></span>
                        <?php endif; ?>
                        <?php
                        $artwork_dimensions = get_field('artwork_dimensions');
                        if ( $artwork_year && $artwork_dimensions ) {
                            echo '<span class="mx-2">&middot;</span>';
                        }
                        if ( $artwork_dimensions ) : ?>
                        <span><?php echo esc_html( $artwork_dimensions ); ?></span>
                        <?php endif; ?>
                    </div>
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

            <!-- Display the gallery if a shortcode exists -->
            <?php
            $gallery_shortcode = get_field('artwork_gallery_shortcode');
            if ( $gallery_shortcode ) :
            ?>
            <div class="artwork-gallery mt-16">
                <h2 class="text-2xl font-bold mb-6">Variations & Details</h2>
                <?php echo do_shortcode( $gallery_shortcode ); ?>
            </div>
            <?php endif; ?>
        </div>

        <?php endif; ?>

    </article>

    <?php endwhile; ?>

</div>

<?php get_footer(); ?>