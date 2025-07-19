<?php
/**
 * Front Page Mosaic Template
 * This final version links each tile to the correct /portfolio/ page with a pre-selected filter.
 *
 * @package Art_Portfolio_Theme
 */

// Build items array from ACF fields
$items = [];
// THIS IS THE FIX: We now explicitly use the URL of your portfolio page.
$portfolio_page_url = home_url('/portfolio/'); 

// Helper to add image items. Now fetches the category filter link.
function add_image_item( $post_object, $portfolio_url ) {
    if ( $post_object ) {
        $terms = get_the_terms( $post_object->ID, 'medium' );
        $caption_text = 'Artwork';
        $filter_link = $portfolio_url; // Default to the main portfolio page

        if ( !empty($terms) && !is_wp_error($terms) ) {
            $caption_text = $terms[0]->name;
            // Create a link like /portfolio/?filter=sculpture-3d
            $filter_link = add_query_arg('filter', $terms[0]->slug, $portfolio_url);
        }
        
        return [
            'type'      => 'image',
            'image_id'  => get_post_thumbnail_id( $post_object->ID ),
            'caption'   => $caption_text,
            'link'      => $filter_link,
        ];
    }
    return false;
}

// Add items from ACF
if ($item = add_image_item(get_field('featured_painting_artwork'), $portfolio_page_url)) $items[] = $item;
if ($item = add_image_item(get_field('featured_sculpture_artwork'), $portfolio_page_url)) $items[] = $item;
if ($item = add_image_item(get_field('featured_collage_artwork'), $portfolio_page_url)) $items[] = $item;
if ($item = add_image_item(get_field('featured_cyanotype_artwork'), $portfolio_page_url)) $items[] = $item;

// Add Video - also linking to its category filter
$video_post = get_field('featured_video_artwork');
if ( $video_post ) {
    $video_field = get_field('featured_video_background_clip');
    $terms = get_the_terms( $video_post->ID, 'medium' );
    $filter_link = ( !empty($terms) && !is_wp_error($terms) ) ? add_query_arg('filter', $terms[0]->slug, $portfolio_page_url) : $portfolio_page_url;

    if ( $video_field ) {
        $items[] = [ 'type' => 'video', 'url' => $video_field['url'], 'link' => $filter_link ];
    }
}

// Add Quote/CTA block
$cta_link = get_field('portfolio_cta_link');
if ( $cta_link ) {
    $quote = get_field('quote_text');
    $items[] = [ 'type' => 'quote', 'text' => $quote, 'link' => $cta_link ];
}
?>

<section id="featured-works" class="container mx-auto px-2 mt-4 md:mt-6">
    <div class="container mx-auto px-2">
        <div class="grid grid-cols-2 md:grid-cols-3 auto-rows-[65vw] md:auto-rows-fr gap-4">
            <?php foreach ( $items as $index => $item ) :
                $span_class = ($index === 0) ? 'col-span-2 md:row-span-2' : '';
                if ($index === 3) $span_class = 'col-span-2 md:col-span-1';
            ?>
            <div class="<?php echo esc_attr($span_class); ?> relative overflow-hidden group">
                <?php if ( $item['type'] === 'image' ) :
                    $size = ( $index === 0 ) ? 'mosaic-large' : 'mosaic-small';
                    $thumb_url = wp_get_attachment_image_url( $item['image_id'], $size );
                ?>
                <a href="<?php echo esc_url($item['link']); ?>" class="block w-full h-full"
                    aria-label="View all <?php echo esc_attr($item['caption']); ?> works">
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($item['caption']); ?>"
                        class="object-cover w-full h-full transform transition-transform duration-300 group-hover:scale-105" />
                    <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-white text-lg font-bold"><?php echo esc_html($item['caption']); ?></h3>
                    </div>
                </a>
                <?php elseif ( $item['type'] === 'video' ) : ?>
                <a href="<?php echo esc_url($item['link']); ?>" class="block w-full h-full"
                    aria-label="View all Film & Video works">
                    <video src="<?php echo esc_url($item['url']); ?>" class="object-cover w-full h-full" autoplay muted
                        loop playsinline></video>
                </a>
                <?php elseif ( $item['type'] === 'quote' ) : ?>
                <a href="<?php echo esc_url($item['link']); ?>"
                    class="block w-full h-full bg-[#1B3052] text-gray-100 p-8 flex flex-col justify-center text-center">
                    <blockquote class="prose prose-xl italic text-gray-100">
                        <?php if ($item['text']) echo esc_html( $item['text'] ); ?>
                    </blockquote>
                    <span class="mt-4 inline-block font-semibold">View Full Portfolio &rarr;</span>
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>