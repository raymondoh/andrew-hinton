<?php
/**
 * Reusable Site Footer Component
 *
 * @package WP_Boilerplate
 */
?>

<footer class="footer p-10 bg-accent text-neutral-content">
    <div class="container mx-auto text-center">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
            <?php echo get_theme_mod( 'wp_boilerplate_footer_copyright', 'All rights reserved.' ); ?></p>
    </div>
</footer>