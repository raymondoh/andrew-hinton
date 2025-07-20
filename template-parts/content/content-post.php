<?php
/**
 * Template part for displaying a single post in a list (e.g., on the Journal page).
 * This version adds a "Read More" link after the excerpt.
 *
 * @package Art_Portfolio_Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group flex flex-col md:flex-row md:items-start md:gap-8'); ?>>

    <!-- Left Column: Text Content -->
    <div class="flex-1">
        <header class="entry-header mb-4">
            <div class="text-sm text-gray-500 mb-2">
                <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
            </div>

            <?php the_title( sprintf( '<h2 class="entry-title text-2xl font-bold text-dark leading-tight"><a href="%s" rel="bookmark" class="hover:text-accent transition-colors">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        </header>

        <div class="entry-summary prose max-w-none">
            <?php the_excerpt(); ?>
        </div>

        <!-- MODIFICATION: Add the "Read More" link -->
        <div class="mt-4">
            <a href="<?php the_permalink(); ?>"
                class="inline-flex items-center font-semibold text-accent hover:underline">
                Read More
                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <!-- END MODIFICATION -->
    </div>

    <!-- Right Column: Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="w-full md:w-56 mt-6 md:mt-0">
        <a href="<?php the_permalink(); ?>" class="block overflow-hidden shadow-md aspect-w-1 aspect-h-1">
            <?php the_post_thumbnail('journal-thumb', ['class' => 'w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105']); ?>
        </a>
    </div>
    <?php endif; ?>

</article>