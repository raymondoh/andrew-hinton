<?php
/**
 * Template Name: Contact Page
 * This definitive version pulls all contact details dynamically and removes link underlines for a cleaner look.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); 

// --- Get Contact Details ---
$settings_page = get_page_by_path('site-settings');
$email = '';
$instagram_url = '';
$youtube_url = '';

if ( $settings_page ) {
    $settings_page_id = $settings_page->ID;
    $email = get_field('contact_email', $settings_page_id);
    $instagram_url = get_field('instagram_profile_url', $settings_page_id);
    $youtube_url = get_field('youtube_channel_url', $settings_page_id);
}
?>

<div class="contact-page-content">

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="relative bg-base-300 h-[20vh] min-h-[200px]">
        <div class="absolute inset-0">
            <?php the_post_thumbnail('full', array('class' => 'w-full h-full object-cover')); ?>
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative h-full flex items-center justify-center text-center">
            <h1 class="text-4xl lg:text-6xl font-bold font-serif text-white"><?php the_title(); ?></h1>
        </div>
    </div>
    <?php endif; ?>


    <div class="container mx-auto px-4 py-4 md:py-16">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 auto-rows-min">

                <div class="bg-base-300 p-8 sm:col-span-2">
                    <h2 class="text-2xl font-serif font-bold mb-4">Get in Touch</h2>
                    <div class="prose prose-lg text-base-content/80">
                        <?php
                        while ( have_posts() ) : the_post();
                            the_content();
                        endwhile;
                        ?>
                    </div>
                </div>

                <?php if ( $email ) : ?>
                <div class="bg-base-300 p-8">
                    <h3 class="text-xl font-serif font-bold mb-2">Email</h3>
                    <!-- MODIFICATION: Added no-underline and hover:underline -->
                    <a href="mailto:<?php echo esc_attr($email); ?>"
                        class="link link-primary no-underline hover:underline break-all"><?php echo esc_html($email); ?></a>
                </div>
                <?php endif; ?>

                <?php if ( $instagram_url ) : ?>
                <div class="bg-base-300 p-8">
                    <h3 class="text-xl font-serif font-bold mb-2">Instagram</h3>
                    <!-- MODIFICATION: Added no-underline and hover:underline -->
                    <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer"
                        class="link link-primary no-underline hover:underline">Follow on Instagram</a>
                </div>
                <?php endif; ?>

                <?php if ( $youtube_url ) : ?>
                <div class="bg-base-300 p-8 sm:col-span-2">
                    <h3 class="text-xl font-serif font-bold mb-2">YouTube</h3>
                    <!-- MODIFICATION: Added no-underline and hover:underline -->
                    <a href="<?php echo esc_url($youtube_url); ?>" target="_blank" rel="noopener noreferrer"
                        class="link link-primary no-underline hover:underline">View on YouTube</a>
                </div>
                <?php endif; ?>

            </div>

            <div class="contact-form bg-base-300 p-8">
                <h2 class="text-2xl font-serif font-bold mb-4">Send a Message</h2>
                <?php 
                // This assumes your WPForms shortcode is correct.
                echo do_shortcode('[wpforms id="71"]'); 
                ?>
            </div>

        </div>

    </div>
</div>

<?php get_footer(); ?>