<?php
/**
 * Reusable Recent Posts Component
 */

// Arguments to fetch ONLY the latest 3 posts.
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 3, // This is the line that limits the posts to 3.
    'ignore_sticky_posts' => 1,
);

$recent_posts_query = new WP_Query($args);

if ( $recent_posts_query->have_posts() ) : ?>

<section class="bg-base-100 py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold">From Our Blog</h2>
            <p class="text-lg text-base-content/70 mt-2">News, articles, and insights from our team.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
                // We will use the same content card we created for the blog archive.
                get_template_part( 'template-parts/content/content', get_post_format() );
            endwhile;
            ?>
        </div>
    </div>
</section>

<?php 
endif; 
wp_reset_postdata(); // Important: Reset the post data.
?>