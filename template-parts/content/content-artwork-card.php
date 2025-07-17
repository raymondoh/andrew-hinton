<?php
/**
 * Template part for displaying a single artwork card.
 * Final version with a correctly placed title overlay on hover.
 *
 * @package Art_Portfolio_Theme
 */

if ( has_post_thumbnail() ) :

    $image_url_thumb = get_the_post_thumbnail_url( get_the_ID(), 'portfolio-thumb' );
    $image_url_full  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
    $artwork_title   = get_the_title();
    $artwork_link    = get_permalink();

    // The linked title for the lightbox caption
    $caption_html = sprintf(
        '<a href="%s" class="text-white hover:underline focus:underline">%s</a>',
        esc_url( $artwork_link ),
        esc_html( $artwork_title )
    );
?>
<div>
    <a href="<?php echo esc_url( $image_url_full ); ?>" data-fancybox="gallery"
        data-caption="<?php echo esc_attr( $caption_html ); ?>"
        class="block relative aspect-w-1 aspect-h-1 overflow-hidden shadow-md group bg-base-200"
        aria-label="View larger image for <?php echo esc_attr( $artwork_title ); ?>">

        <img src="<?php echo esc_url( $image_url_thumb ); ?>" alt="<?php echo esc_attr( $artwork_title ); ?>"
            class="w-full h-full object-cover transform transition-transform duration-300 ease-in-out group-hover:scale-105">

        <div
            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out flex items-center justify-center p-4">
            <h3 class="text-white text-lg font-bold text-center">
                <?php echo esc_html( $artwork_title ); ?>
            </h3>
        </div>
    </a>
</div>

<?php
else :
?>
<div
    class="aspect-w-1 aspect-h-1 bg-rose-100 border-2 border-dashed border-rose-400 flex items-center justify-center p-4">
    <div class="text-center text-rose-800">
        <p class="font-bold text-lg">Image Missing!</p>
        <p class="text-sm">Please set a "Featured Image" for the artwork titled:</p>
        <p class="text-sm font-semibold mt-1">"<?php the_title(); ?>"</p>
    </div>
</div>
<?php
endif;
?>