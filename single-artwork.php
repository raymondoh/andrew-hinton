<?php
/**
 * Template part for displaying a single artwork card.
 * New Layout: Image opens a lightbox, and a linked title appears below.
 * Includes a fallback for missing featured images.
 *
 * @package Art_Portfolio_Theme
 */

// Check if a Featured Image has been set for this artwork post.
if ( has_post_thumbnail() ) :

    $image_url_large = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    $image_url_full  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    $artwork_title   = get_the_title();
    $artwork_link    = get_permalink();
?>
<div>
    <a href="<?php echo esc_url( $image_url_full ); ?>" data-fancybox="gallery"
        data-caption="<?php echo esc_attr( $artwork_title ); ?>"
        class="block rounded-lg overflow-hidden shadow-md group"
        aria-label="View larger image for <?php echo esc_attr( $artwork_title ); ?>">

        <img src="<?php echo esc_url( $image_url_large ); ?>" alt="<?php echo esc_attr( $artwork_title ); ?>"
            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300 ease-in-out">
    </a>

    <div class="mt-4">
        <h3 class="text-lg font-semibold text-base-content leading-tight">
            <a href="<?php echo esc_url( $artwork_link ); ?>" class="hover:underline focus:underline">
                <?php echo esc_html( $artwork_title ); ?>
            </a>
        </h3>
    </div>

</div>

<?php
else :
    // --- THIS IS THE CRITICAL FALLBACK ---
    // If you see this on your page, it means the artwork post is missing its "Featured Image".
?>
<div
    class="aspect-w-1 aspect-h-1 bg-rose-100 border-2 border-dashed border-rose-400 rounded-lg flex items-center justify-center p-4">
    <div class="text-center text-rose-800">
        <p class="font-bold text-lg">Image Missing!</p>
        <p class="text-sm">Please set a "Featured Image" for the artwork titled:</p>
        <p class="text-sm font-semibold mt-1">"<?php the_title(); ?>"</p>
    </div>
</div>
<?php
endif;
?>