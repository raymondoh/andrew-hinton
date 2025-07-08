<?php
/**
 * Reusable Navbar Component
 *
 * Uses wp_nav_menu() for the links and Alpine.js for interactivity.
 *
 * @package WordPress
 * @subpackage your-theme-name
 */
?>

<div x-data="{ open: false, dropdownOpen: false }" class="bg-base-100 shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center transition-all duration-300"
            :class="{ 'py-4': atTop, 'py-2': !atTop }">

            <div class="font-bold">
                <?php if ( has_custom_logo() ) : ?>
                <div class="site-logo transition-all duration-300" :class="{ 'w-40': atTop, 'w-32': !atTop }">
                    <?php the_custom_logo(); ?>
                </div>
                <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>"
                    class="text-base-content no-underline hover:opacity-80 transition-all duration-300"
                    :class="{ 'text-2xl': atTop, 'text-xl': !atTop }">
                    <?php bloginfo('name'); ?>
                </a>
                <?php endif; ?>
            </div>

            <nav class="hidden md:flex items-center space-x-4">
                <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'walker'         => new Your_Theme_Name_Walker_Nav_Menu(),
        ));
        ?>
            </nav>

            <div class="md:hidden">
                <button @click="open = !open" class="text-base-content">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2" class="md:hidden" style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <?php
        // We now use our new, simple Mobile_Nav_Walker
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '%3$s', // No <ul> wrapper needed
          'walker'         => new Mobile_Nav_Walker(),
        ));
        ?>
        </div>
    </div>
</div>