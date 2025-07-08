<?php
/**
 * The template for displaying the new static homepage.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); 

// Get the featured image URL for the background
$hero_image_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : 'https://via.placeholder.com/1920x1080'; // Fallback
?>

<div class="min-h-[calc(100vh-7rem)] bg-cover bg-center flex items-center justify-center text-center text-white"
    style="background-image: url('<?php echo esc_url($hero_image_url); ?>');">
    <div class="bg-black bg-opacity-40 p-8 rounded-lg">
        <h1 class="text-4xl md:text-6xl font-serif font-bold mb-4">Andrew Hinton</h1>
        <p class="text-lg md:text-xl mb-8">Contemporary Artist</p>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'portfolio' ) ) ); ?>"
            class="btn btn-primary btn-wide">View Portfolio</a>
    </div>
</div>

<?php 
get_footer(); 
?>