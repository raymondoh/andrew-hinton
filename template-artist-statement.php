<?php
/**
 * Template Name: Artist Statement & CV
 *
 * This version adds a main page title for consistency with the Journal page.
 *
 * @package Art_Portfolio_Theme
 */

get_header();

// Get the page ID for the current page
$page_id = get_the_ID();

// Get the 'Site Settings' page to fetch site-wide data
$settings_page = get_page_by_path('site-settings');
$settings_page_id = $settings_page ? $settings_page->ID : 0;
?>

<main id="main" class="site-main">
    <div class="container mx-auto px-4 py-16">

        <!-- MODIFICATION: Added a page header -->
        <header class="page-header mb-12">
            <?php the_title( '<h1 class="text-4xl lg:text-5xl font-bold font-serif text-dark">', '</h1>' ); ?>
        </header>
        <!-- END MODIFICATION -->

        <!-- Main two-column grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">

            <!-- Left Column: Artist Photo -->
            <div class="lg:col-span-1">
                <div class="h-[60vh] md:h-auto lg:sticky lg:top-8">
                    <?php
                    $photo_id = get_field('artist_photo', $page_id);
                    if ( $photo_id ) :
                        echo wp_get_attachment_image($photo_id, 'artist-photo', false, ['class' => 'w-full h-full object-cover  shadow-lg']);
                    endif;
                    ?>
                </div>
                <?php
                $photo_caption = get_field('photo_caption', $page_id);
                if ( $photo_caption ) :
                ?>
                <p class="text-sm text-gray-500 mt-2 text-center"><?php echo esc_html($photo_caption); ?></p>
                <?php endif; ?>
            </div>

            <!-- Right Column: Scrollable Text Content -->
            <div class="lg:col-span-1">
                <div class="prose prose-lg max-w-none">

                    <?php
                    // Display Artist Statement
                    $statement = get_field('artist_statement', $page_id);
                    if ( $statement ) {
                        echo wp_kses_post($statement);
                    }

                    // Display Featured Quote
                    $quote = get_field('featured_quote', $page_id);
                    if ( $quote ) :
                    ?>
                    <blockquote class="border-l-4 border-accent pl-6 italic my-8">
                        <?php echo esc_html($quote); ?>
                    </blockquote>
                    <?php 
                    endif;

                    // Upcoming Events Section
                    $upcoming_events = get_field('upcoming_events', $settings_page_id);
                    if ( $upcoming_events ) :
                    ?>
                    <div class="upcoming-events-section my-12 p-6 bg-base-200 rounded-lg">
                        <h2 class="text-2xl font-bold mt-0 mb-4">Upcoming</h2>
                        <div class="prose-sm">
                            <?php echo wp_kses_post($upcoming_events); ?>
                        </div>
                    </div>
                    <?php
                    endif;

                    // CV Section
                    $cv_sections = [
                        'Solo Exhibitions'                   => 'cv_solo_exhibitions',
                        'Group Exhibitions & Collaborations' => 'cv_group_exhibitions',
                        'Performances'                       => 'cv_performances',
                        'Residencies & Programmes'           => 'cv_residencies_programmes',
                        'Awards'                             => 'cv_awards',
                    ];

                    $first_section_rendered = false;

                    foreach ( $cv_sections as $title => $field_name ) {
                        $content = get_field($field_name, $page_id);

                        if ( $content ) {
                            if ( $first_section_rendered ) {
                                echo '<hr class="my-12 border-gray-300">';
                            }
                            echo '<h2 class="text-2xl font-bold mb-4">' . esc_html($title) . '</h2>';
                            echo wp_kses_post($content);
                            $first_section_rendered = true;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();