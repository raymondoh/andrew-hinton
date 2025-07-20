<?php
/**
 * The template for the main blog/journal page.
 * This version corrects the padding above the first post.
 *
 * @package Art_Portfolio_Theme
 */

get_header();

// Get the 'Site Settings' page to fetch site-wide data
$settings_page = get_page_by_path('site-settings');
$settings_page_id = $settings_page ? $settings_page->ID : 0;
?>

<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-16">

        <!-- Main Column: Journal Posts -->
        <main id="main" class="site-main lg:col-span-2">

            <header class="page-header mb-12">
                <h1 class="text-4xl lg:text-6xl font-bold font-serif text-dark">Journal</h1>
            </header>

            <?php if ( have_posts() ) : ?>
            <div class="divide-y divide-gray-300">
                <?php
                    // Start the Loop
                    while ( have_posts() ) :
                        the_post();
                        // MODIFICATION: The padding is now only applied to the bottom of each post,
                        // and top padding is added to every post EXCEPT the first one.
                        echo '<div class="pt-12 pb-12 first:pt-0">';
                        get_template_part( 'template-parts/content/content-post' );
                        echo '</div>';
                    endwhile;
                    ?>
            </div>

            <?php
                // Add pagination links
                the_posts_pagination( array(
                    'prev_text' => '&larr; Previous',
                    'next_text' => 'Next &rarr;',
                ) );
                ?>

            <?php else : ?>
            <p class="prose prose-lg">No journal entries have been published yet. Please add a new post in the admin
                dashboard.</p>
            <?php endif; ?>

        </main>

        <!-- Sidebar Column: Sticky Events -->
        <aside class="lg:col-span-1">
            <div class="sticky top-28">
                <?php
                $upcoming_events = get_field('upcoming_events', $settings_page_id);
                if ( $upcoming_events ) :
                ?>
                <div class="upcoming-events-section p-6 bg-base-200 rounded-lg">
                    <h2 class="text-2xl font-bold mt-0 mb-4">Upcoming</h2>
                    <div class="prose prose-sm">
                        <?php echo wp_kses_post($upcoming_events); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </aside>

    </div>
</div>

<?php
get_footer();