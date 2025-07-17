<?php
/**
 * Front Page Section: Featured Painting
 * This version now includes a link to the full category archive.
 *
 * @package Art_Portfolio_Theme
 */

$featured_painting_post = get_field('featured_painting_artwork');

if ( $featured_painting_post ) :
    $post = $featured_painting_post;
    setup_postdata( $post );

    // Get the link to the 'Painting & Drawing' medium archive page
    $category_link = get_term_link( 'painting-drawing', 'medium' );
?>
<section class="grid grid-cols-1 md:grid-cols-2 gap-2">

    <div>
        <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="block h-full">
            <?php the_post_thumbnail('featured-landscape', array('class' => 'w-full h-full object-cover')); ?>
        </a>
        <?php endif; ?>
    </div>

    <div class="bg-gray-300 flex items-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-xl font-serif font-semibold mb-4">Painting & Drawing</h2>
            <div class="prose max-w-none text-lg mb-6">
                <?php the_field('featured_painting_text'); ?>
            </div>

            <div class="flex flex-wrap items-center gap-4">
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Details</a>
                <?php if ( ! is_wp_error( $category_link ) ) : ?>
                <a href="<?php echo esc_url( $category_link ); ?>" class="btn btn-outline">View All Paintings</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php 
    wp_reset_postdata();
endif; 
?>