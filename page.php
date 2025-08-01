<?php
/**
 * The template for displaying all static pages.
 *
 * @package Art_Portfolio_Theme
 */

get_header();
?>

<div class="container mx-auto px-4">
    <div class="fade-in-element" x-data="{ inView: false }" x-intersect:enter="inView = true"
        :class="{ 'is-visible': inView }">
        <?php
        while ( have_posts() ) :
            the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header text-center mb-12">
                <?php the_title( '<h1 class="text-4xl md:text-6xl font-bold">', '</h1>' ); ?>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
            <figure class="max-w-2xl mx-auto mb-12">
                <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>"
                    class="w-full h-auto shadow-lg">
            </figure>
            <?php endif; ?>

            <div class="entry-content prose lg:prose-xl max-w-3xl mx-auto">
                <?php
                    the_content();
                ?>
            </div>
        </article>

        <?php
        endwhile; // End of the loop.
        ?>
    </div>
</div>

<?php
get_footer();