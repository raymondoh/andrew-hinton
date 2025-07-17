<?php
/**
 * Front Page Section: Featured Sculpture
 * This version now includes a link to the full category archive.
 *
 * @package Art_Portfolio_Theme
 */

$featured_sculpture_post = get_field('featured_sculpture_artwork');

if ( $featured_sculpture_post ) :
    $post = $featured_sculpture_post;
    setup_postdata( $post );

    // Get the link to the 'Sculpture & 3D' medium archive page
    $category_link = get_term_link( 'sculpture-3d', 'medium' );
?>
<section class="mt-2">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="md:order-2">
            <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" class="block h-full">
                <?php the_post_thumbnail('featured-landscape', array('class' => 'w-full h-full object-cover')); ?>
            </a>
            <?php endif; ?>
        </div>

        <div class="md:order-1 bg-base-100 flex items-center">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <h2 class="text-4xl font-serif font-bold mb-4">Sculpture & 3D</h2>
                <div class="prose max-w-none text-lg mb-6">
                    <?php the_field('featured_sculpture_text'); ?>
                </div>

                <div class="flex flex-wrap items-center gap-4">
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">View Details</a>
                    <?php if ( ! is_wp_error( $category_link ) ) : ?>
                    <a href="<?php echo esc_url( $category_link ); ?>" class="btn btn-outline">View All Sculptures</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    wp_reset_postdata();
endif; 
?>