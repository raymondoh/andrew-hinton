<?php
/**
 * Template part for a single artwork card (for Fancybox).
 */
$full_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
?>
<a href="<?php echo esc_url($full_image_url); ?>" data-fancybox="artwork-gallery" class="group block">
    <figure class="aspect-square bg-gray-100 overflow-hidden">
        <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
        <?php endif; ?>
    </figure>
</a>