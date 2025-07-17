<?php
/**
 * Front Page Section: Featured Video
 * This version now includes a link to the full category archive.
 *
 * @package Art_Portfolio_Theme
 */

$bg_video_url = get_field('featured_video_background_clip'); 
$featured_video_post = get_field('featured_video_artwork');

if ( $bg_video_url && $featured_video_post ) :
    $post = $featured_video_post;
    setup_postdata( $post );

    // Get the link to the 'Film & Video' medium archive page
    $category_link = get_term_link( 'film-video', 'medium' );
?>
<section
    class="relative h-[80vh] min-h-[500px] w-full flex items-center justify-center text-center text-white overflow-hidden mb-2">

    <video src="<?php echo esc_url( $bg_video_url['url'] ); ?>" autoplay loop muted playsinline
        class="absolute top-0 left-0 w-full h-full object-cover z-0"></video>
    <div class="absolute top-0 left-0 w-full h-full bg-black/50 z-10"></div>

    <div class="relative z-20 container mx-auto px-4">
        <h2 class="text-4xl lg:text-6xl font-serif font-bold mb-4">Film & Video</h2>
        <div class="prose prose-xl max-w-3xl mx-auto text-white/90 mb-8">
            <?php the_field('featured_video_text'); ?>
        </div>

        <div class="flex flex-wrap justify-center items-center gap-4">
            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-lg">View Project</a>
            <?php if ( ! is_wp_error( $category_link ) ) : ?>
            <a href="<?php echo esc_url( $category_link ); ?>" class="btn btn-outline btn-lg text-white">View All Film &
                Video</a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php 
    wp_reset_postdata();
endif; 
?>