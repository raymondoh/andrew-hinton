    </main><!-- #main -->

    <?php
    // --- Social Links Logic ---
    // Get the 'Site Settings' page by its slug
    $settings_page = get_page_by_path('site-settings');
    $instagram_url = '';
    $youtube_url = '';

    // Check if the page exists before trying to get fields from it
    if ( $settings_page ) {
        $settings_page_id = $settings_page->ID;
        $instagram_url = get_field('instagram_profile_url', $settings_page_id);
        $youtube_url = get_field('youtube_channel_url', $settings_page_id);
    }
    ?>

    <footer class="footer p-8 bg-accent text-neutral-content">
        <!-- MODIFICATION: This container now uses flexbox for responsive alignment -->
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-6">

            <!-- Copyright Text (Aligned left on desktop) -->
            <div class="text-center md:text-left text-sm">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
                    <?php echo get_theme_mod( 'andrew_hinton_portfolio_footer_copyright', 'All rights reserved.' ); ?>
                </p>
            </div>

            <?php
            // Only display the social links container if at least one URL exists
            if ( $instagram_url || $youtube_url ) :
            ?>
            <!-- Social Links (Aligned right on desktop) -->
            <div class="social-links flex items-center space-x-5">
                <?php if ( $instagram_url ) : ?>
                <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer"
                    class="text-neutral-content/70 hover:text-neutral-content transition-colors">
                    <span class="sr-only">Instagram</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12 2c-2.717 0-3.056.01-4.122.06-1.065.05-1.79.217-2.428.465a4.898 4.898 0 00-1.772 1.153 4.942 4.942 0 00-1.153 1.772c-.247.638-.415 1.363-.465 2.428C2.01 8.944 2 9.283 2 12s.01 3.056.06 4.122c.05 1.065.218 1.79.465 2.428a4.898 4.898 0 001.153 1.772 4.942 4.942 0 001.772 1.153c.638.247 1.363.415 2.428.465C8.944 21.99 9.283 22 12 22s3.056-.01 4.122-.06c1.065-.05 1.79-.218 2.428-.465a4.898 4.898 0 001.772-1.153 4.942 4.942 0 001.153-1.772c.247-.638.415-1.363.465-2.428C21.99 15.056 22 14.717 22 12s-.01-3.056-.06-4.122c-.05-1.065-.218-1.79-.465-2.428a4.898 4.898 0 00-1.153-1.772 4.942 4.942 0 00-1.772-1.153c-.638-.247-1.363-.415-2.428-.465C15.056 2.01 14.717 2 12 2zm0 4.625a5.375 5.375 0 100 10.75 5.375 5.375 0 000-10.75zm0 8.625a3.25 3.25 0 110-6.5 3.25 3.25 0 010 6.5zm6.25-9.375a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <?php endif; ?>

                <?php if ( $youtube_url ) : ?>
                <a href="<?php echo esc_url($youtube_url); ?>" target="_blank" rel="noopener noreferrer"
                    class="text-neutral-content/70 hover:text-neutral-content transition-colors">
                    <span class="sr-only">YouTube</span>
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M19.802 5.392a2.44 2.44 0 00-1.72-1.72C16.538 3.5 12 3.5 12 3.5s-4.538 0-6.082.172a2.44 2.44 0 00-1.72 1.72C4 6.938 4 12 4 12s0 5.062.198 6.608a2.44 2.44 0 001.72 1.72c1.544.172 6.082.172 6.082.172s4.538 0 6.082-.172a2.44 2.44 0 001.72-1.72C20 17.062 20 12 20 12s0-5.062-.198-6.608zM9.545 15.5v-7l6.5 3.5-6.5 3.5z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <?php endif; ?>
            </div>
            <?php 
            endif; 
            ?>
        </div>
    </footer>

    </div><!-- From header.php -->

    <?php wp_footer(); ?>

    </body>

    </html>