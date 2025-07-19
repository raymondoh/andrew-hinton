<?php
/**
 * Template Name: Artist Statement & CV
 *
 * This template creates a two-column layout for the artist's statement and CV.
 * This version adds a responsive height to the artist photo for mobile.
 *
 * @package Art_Portfolio_Theme
 */

get_header();

// Get the page ID
$page_id = get_the_ID();
?>

<main id="main" class="site-main">
    <div class="container mx-auto mt-12 px-4 py-8 md:py-16">

        <!-- Main two-column grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">

            <!-- Left Column: Artist Photo -->
            <div class="lg:col-span-1">
                <!-- MODIFICATION: The 'sticky' container is now inside a div with responsive height -->
                <div class="h-[60vh] md:h-auto lg:sticky lg:top-8">
                    <?php
                    $photo_id = get_field('artist_photo', $page_id);
                    if ( $photo_id ) :
                        // The image tag now has h-full to fill its container
                        echo wp_get_attachment_image($photo_id, 'artist-photo', false, ['class' => 'w-full h-full object-cover rounded-md shadow-lg']);
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

                    // --- CV Section ---
                    
                    // Logic to render sections with horizontal lines
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
                            // If this isn't the first section with content, add a separator line.
                            if ( $first_section_rendered ) {
                                echo '<hr class="my-12 border-gray-300">';
                            }

                            // Render the section title and content.
                            echo '<h2 class="text-2xl font-bold mb-4">' . esc_html($title) . '</h2>';
                            echo wp_kses_post($content);

                            // Mark that we have now rendered at least one section.
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