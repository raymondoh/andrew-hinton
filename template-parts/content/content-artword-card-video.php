<?php
/**
 * Template part for displaying a single VIDEO artwork card on the home page.
 * This card displays the video player directly.
 *
 * @package Art_Portfolio_Theme
 */
?>
<div class="video-card">

    <div class="entry-content aspect-video mb-4">
        <?php the_content(); ?>
    </div>

    <h3 class="text-lg font-semibold text-base-content leading-tight">
        <a href="<?php the_permalink(); ?>" class="hover:underline focus:underline">
            <?php the_title(); ?>
        </a>
    </h3>

</div>