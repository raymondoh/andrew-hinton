<?php
/**
 * Front Page Mosaic Template
 * This version re-orders the grid to place the video in the 4th position.
 *
 * @package Art_Portfolio_Theme
 */

// Build items array from ACF fields
$items = [];
// This is the URL of your main portfolio page.
$portfolio_page_url = home_url('/portfolio/'); 

// Helper to add image items. Now fetches the category filter link.
function add_image_item( $post_object, $portfolio_url ) {
    if ( $post_object ) {
        $terms = get_the_terms( $post_object->ID, 'medium' );
        $caption_text = 'Artwork';
        $filter_link = $portfolio_url; // Default to the main portfolio page

        if ( !empty($terms) && !is_wp_error($terms) ) {
            $caption_text = $terms[0]->name;
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

// --- MODIFICATION: The order of items is changed here ---

// Add items from ACF
if ($item = add_image_item(get_field('featured_painting_artwork'), $portfolio_page_url)) $items[] = $item;
if ($item = add_image_item(get_field('featured_sculpture_artwork'), $portfolio_page_url)) $items[] = $item;
if ($item = add_image_item(get_field('featured_collage_artwork'), $portfolio_page_url)) $items[] = $item;

// Add Video (Now in the 4th position)
$video_post = get_field('featured_video_artwork');
if ( $video_post ) {
    $video_field = get_field('featured_video_background_clip');
    $terms = get_the_terms( $video_post->ID, 'medium' );
    
    $video_caption = 'Video'; // Default caption
    $filter_link = $portfolio_page_url; // Default link

    if ( !empty($terms) && !is_wp_error($terms) ) {
        $video_caption = $terms[0]->name;
        $filter_link = add_query_arg('filter', $terms[0]->slug, $portfolio_page_url);
    }

    if ( $video_field ) {
        $items[] = [ 
            'type'    => 'video', 
            'url'     => $video_field['url'], 
            'link'    => $filter_link,
            'caption' => $video_caption 
        ];
    }
}

// Add Cyanotype (Now in the 5th position)
if ($item = add_image_item(get_field('featured_cyanotype_artwork'), $portfolio_page_url)) $items[] = $item;


// Add Instagram Block
$instagram_profile_url = 'https://www.instagram.com/raymondoh13/'; 
$instagram_container_page_url = 'https://andrew-hinton-portfolio.local:8890/instagram-feed-container/';

$items[] = [ 
    'type'        => 'instagram', 
    'iframe_url'  => $instagram_container_page_url,
    'profile_url' => $instagram_profile_url,
];
// --- END MODIFICATION ---
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

                <?php 
                elseif ( $item['type'] === 'video' ) : 
                ?>
                <!-- Desktop-only version: A link to the category page -->
                <a href="<?php echo esc_url($item['link']); ?>" class="hidden md:block w-full h-full"
                    aria-label="View all <?php echo esc_attr($item['caption']); ?> works">
                    <video src="<?php echo esc_url($item['url']); ?>" class="object-cover w-full h-full" autoplay muted
                        loop playsinline></video>
                    <div class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-white text-lg font-bold"><?php echo esc_html($item['caption']); ?></h3>
                    </div>
                </a>

                <!-- Mobile-only version: Just the video, no link -->
                <div class="block md:hidden w-full h-full">
                    <video src="<?php echo esc_url($item['url']); ?>" class="object-cover w-full h-full" autoplay muted
                        loop playsinline></video>
                    <div
                        class="absolute bottom-0 left-0 w-full p-6 bg-gradient-to-t from-black/70 to-transparent pointer-events-none">
                        <h3 class="text-white text-lg font-bold"><?php echo esc_html($item['caption']); ?></h3>
                    </div>
                </div>
                <?php 
                elseif ( $item['type'] === 'instagram' ) : 
                ?>
                <a href="<?php echo esc_url($item['profile_url']); ?>" target="_blank" rel="noopener noreferrer"
                    class="block w-full h-full" aria-label="View on Instagram">
                    <iframe src="<?php echo esc_url($item['iframe_url']); ?>" class="w-full h-full border-0"
                        scrolling="no" title="Instagram Feed"></iframe>
                </a>
                <?php 
                endif; 
                ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>