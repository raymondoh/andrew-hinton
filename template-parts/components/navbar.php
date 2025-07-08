<?php
/**
 * Reusable Navbar Component
 *
 * Uses wp_nav_menu() for the links and Alpine.js for interactivity.
 * The mobile menu now slides in from the right.
 *
 * @package WordPress
 * @subpackage your-theme-name
 */
?>

<div x-data="{ open: false }">

    <div class="bg-base-100 shadow-md relative z-10">
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
                                d="M4 6h16M4 12h16M12 18h8" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" class="md:hidden fixed inset-0 z-50 flex" style="display: none;">

        <div @click="open = false" x-show="open" x-transition:enter="transition-opacity ease-in-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in-out duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50"></div>

        <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="relative ml-auto h-full w-full max-w-xs bg-base-100 shadow-xl flex flex-col z-50">

            <div class="flex items-center justify-between px-4 py-4 border-b border-base-200">
                <span class="font-bold text-lg">Menu</span>
                <button @click="open = false" class="text-base-content">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <?php
                wp_nav_menu(array(
                  'theme_location' => 'primary',
                  'container'      => false,
                  'items_wrap'     => '%3$s',
                  'walker'         => new Mobile_Nav_Walker(),
                ));
                ?>
            </div>
        </div>
    </div>
</div>