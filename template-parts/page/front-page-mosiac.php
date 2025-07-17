<?php
/**
 * Front Page Mosaic Template
 * Final version with balanced vertical spacing and a patterned mobile margin.
 *
 * @package Art_Portfolio_Theme
 */

// ... (The PHP code to build the $items array remains exactly the same) ...
$items = [];

// Helper to add image items
function add_image_item( $post_object ) {
    if ( $post_object ) {
        $terms = get_the_terms( $post_object->ID, 'medium' );
        $caption_text = ( !empty($terms) && !is_wp_error($terms) ) ? $terms[0]->name : 'Artwork';
        
        return [
            'type'      => 'image',
            'post_id'   => $post_object->ID,
            'image_id'  => get_post_thumbnail_id( $post_object->ID ),
            'caption'   => $caption_text,
            'link'      => get_permalink( $post_object->ID ),
        ];
    }
    return false;
}

// Add Painting, Sculpture, Collage, Cyanotype
if ($item = add_image_item(get_field('featured_painting_artwork'))) $items[] = $item;
if ($item = add_image_item(get_field('featured_sculpture_artwork'))) $items[] = $item;
if ($item = add_image_item(get_field('featured_collage_artwork'))) $items[] = $item;
if ($item = add_image_item(get_field('featured_cyanotype_artwork'))) $items[] = $item;

// Add Video
$video_field = get_field('featured_video_background_clip');
$video_post = get_field('featured_video_artwork');
if ( $video_field && $video_post ) {
    $items[] = [ 'type' => 'video', 'url' => $video_field['url'], 'link' => get_permalink($video_post->ID) ];
}

// Add Quote
$quote = get_field('quote_text');
$cta_link = get_field('portfolio_cta_link');
if ( $quote && $cta_link ) {
    $items[] = [ 'type' => 'quote', 'text' => $quote, 'link' => $cta_link ];
}
?>

<section id="featured-works" class="pt-4 pb-16 md:py-24">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-3 auto-rows-[65vw] md:auto-rows-fr gap-4">
            <?php foreach ( $items as $index => $item ) :
                // ... (The rest of your loop remains exactly the same) ...
                $span_class = ($index === 0) ? 'col-span-2 md:row-span-2' : '';
                if ($index === 3) $span_class = 'col-span-2 md:col-span-1';
            ?>
            <div class="<?php echo esc_attr($span_class); ?> relative overflow-hidden group">
                <?php if ( $item['type'] === 'image' ) :
                    $size = ( $index === 0 ) ? 'mosaic-large' : 'mosaic-small';
                    $thumb_url = wp_get_attachment_image_url( $item['image_id'], $size );
                ?>
                <a href="<?php echo esc_url($item['link']); ?>" class="block w-full h-full"
                    aria-label="View <?php echo esc_attr($item['caption']); ?>">
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($item['caption']); ?>"
                        class="object-cover w-full h-full transform transition-transform duration-300 group-hover:scale-105" />
                    <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-white text-lg font-bold"><?php echo esc_html($item['caption']); ?></h3>
                    </div>
                </a>
                <?php elseif ( $item['type'] === 'video' ) : ?>
                <a href="<?php echo esc_url($item['link']); ?>" class="block w-full h-full">
                    <video src="<?php echo esc_url($item['url']); ?>" class="object-cover w-full h-full" autoplay muted
                        loop playsinline webkit-playsinline> </video>
                </a>
                <?php elseif ( $item['type'] === 'quote' ) : ?>
                <a href="<?php echo esc_url($item['link']); ?>"
                    class="block w-full h-full bg-[#1B3052] text-gray-100 p-8 flex flex-col justify-center text-center">
                    <blockquote class="prose prose-sm xl:prose-lg italic text-gray-100">
                        <?php echo esc_html( $item['text'] ); ?>
                    </blockquote>

                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>