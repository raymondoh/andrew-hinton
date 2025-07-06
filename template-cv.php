<?php
/**
 * Template Name: CV / Exhibitions Page
 *
 * This is the template that displays the artist's CV,
 * grouping exhibitions, residencies, etc., by year.
 *
 * @package Art_Portfolio_Theme
 */

get_header();

$args = array(
    'post_type'      => 'exhibition',
    'posts_per_page' => -1,
    'meta_key'       => 'event_date', // Our custom field for the year
    'orderby'        => 'meta_value_num', // Order by the year
    'order'          => 'DESC', // Show the most recent year first
);

$cv_query = new WP_Query($args);

// We will create an array to group posts by year.
$grouped_posts = [];

if ($cv_query->have_posts()) {
    while ($cv_query->have_posts()) {
        $cv_query->the_post();
        $year = get_field('event_date'); // The year we saved (e.g., "2024")
        if (!isset($grouped_posts[$year])) {
            $grouped_posts[$year] = [];
        }
        $grouped_posts[$year][] = get_post(); // Add the full post object to the array
    }
}
wp_reset_postdata();
?>

<div class="container mx-auto site-content px-4 pt-28 pb-12 md:pb-20">
    <main id="main" class="site-main">
        <header class="entry-header text-center mb-12">
            <h1 class="text-4xl md:text-6xl font-bold"><?php the_title(); ?></h1>
        </header>

        <div class="entry-content max-w-3xl mx-auto">
            <?php if (!empty($grouped_posts)) : ?>
            <?php foreach ($grouped_posts as $year => $posts) : ?>
            <section class="cv-year-group mb-12">
                <h2 class="text-3xl font-bold border-b border-gray-300 pb-2 mb-6"><?php echo esc_html($year); ?></h2>
                <ul class="space-y-4">
                    <?php foreach ($posts as $post) : setup_postdata($post); 
                                $venue = get_field('venue_location', $post->ID);
                                $type = get_field('event_type', $post->ID);
                            ?>
                    <li>
                        <p class="text-lg"><strong><?php the_title(); ?></strong>, <?php echo esc_html($venue); ?></p>
                        <p class="text-base text-gray-600"><?php echo esc_html($type); ?></p>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <?php endforeach; ?>
            <?php else : ?>
            <p>No CV entries found.</p>
            <?php endif; ?>
        </div>
        </article>
    </main>
</div>

<?php
get_footer();