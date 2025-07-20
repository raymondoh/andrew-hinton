<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('flex flex-col min-h-screen'); ?>>
    <?php wp_body_open(); ?>

    <div x-data="{ open: false, atTop: true }" @scroll.window="atTop = (window.scrollY < 10)"
        x-effect="document.body.classList.toggle('body-no-scroll', open)">

        <header id="masthead" class="site-header fixed top-0 left-0 right-0 z-40 transition-colors duration-300"
            :class="{ 'bg-transparent': atTop, 'shadow-lg bg-accent/95 backdrop-blur-sm': !atTop }">

            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center transition-all duration-300"
                    :class="{ 'py-6': atTop, 'py-3': !atTop }">

                    <!-- Logo -->
                    <div class="font-bold">
                        <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo transition-all duration-300" :class="{ 'w-40': atTop, 'w-32': !atTop }">
                            <?php the_custom_logo(); ?>
                        </div>
                        <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"
                            class="no-underline hover:opacity-80 transition-all duration-300" :class="{
                                'text-2xl': atTop, 
                                'text-xl': !atTop,
                                'text-dark': atTop && document.body.classList.contains('has-light-background'),
                                'text-light': !atTop || !document.body.classList.contains('has-light-background')
                            }">
                            <?php bloginfo('name'); ?>
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- Desktop Menu -->
                    <nav class="hidden md:flex items-center space-x-4">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'container'      => false,
                            'items_wrap'     => '%3$s',
                            'walker'         => new Andrew_Hinton_Walker_Nav_Menu(), 
                        ]);
                        ?>
                    </nav>

                    <!-- Mobile Hamburger Button -->
                    <div class="md:hidden">
                        <button @click="open = !open" :class="{
                                'text-dark': atTop && document.body.classList.contains('has-light-background'),
                                'text-light': !atTop || !document.body.classList.contains('has-light-background')
                            }">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M12 18h8" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
        </header>

        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden fixed inset-0 z-50 flex" style="display: none;">
            <div @click="open = false" x-show="open" x-transition:enter="transition-opacity ease-in-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-in-out duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-50"></div>

            <div x-show="open" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                class="relative ml-auto h-full w-full max-w-xs bg-accent shadow-xl flex flex-col text-light mobile-menu z-50">

                <div class="flex items-center justify-between px-4 py-4 border-b border-support">
                    <span class="font-bold text-lg text-light">Menu</span>
                    <button @click="open = false" class="text-light">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="p-4">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => '',
                        'items_wrap'     => '%3$s',
                        'walker'         => new Mobile_Nav_Walker(),
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div><!-- End Alpine Component -->

    <?php
    // Determine if we need padding for the header based on the body class.
    $main_classes = 'site-main flex-grow';
    if ( in_array('has-light-background', get_body_class()) ) {
        // MODIFICATION: Reduced padding from pt-32 to pt-24
        $main_classes .= ' pt-2'; 
    }
    ?>
    <main id="main" class="<?php echo esc_attr($main_classes); ?>">