<?php
/**
 * Template Name: Contact Page
 * This version now includes a full-width hero section for visual consistency.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); ?>

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

                <div class="bg-base-300 p-8">
                    <h3 class="text-xl font-serif font-bold mb-2">Email</h3>
                    <a href="mailto:andrew@example.com" class="link link-primary">andrew@example.com</a>
                </div>

                <div class="bg-base-300 p-8">
                    <h3 class="text-xl font-serif font-bold mb-2">Instagram</h3>
                    <a href="https://www.instagram.com/andrewse8/" target="_blank" rel="noopener noreferrer"
                        class="link link-primary">@andrewse8</a>
                </div>

            </div>

            <div class="contact-form bg-base-300 p-8">
                <h2 class="text-2xl font-serif font-bold mb-4">Send a Message</h2>
                <?php 
                echo do_shortcode('[wpforms id="71"]'); 
                ?>
            </div>

        </div>

    </div>
</div>

<?php get_footer(); ?>