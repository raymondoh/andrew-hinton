<?php
/**
 * The template for displaying the front page.
 *
 * @package WordPress
 * @subpackage your-theme-name
 */

get_header(); 
?>

<main id="main" class="site-main" role="main">

    <?php
    // Display our Hero Component
    get_template_part('template-parts/components/hero');

    // Add your new Service Cards section
get_template_part('template-parts/components/service-cards');
 get_template_part('template-parts/components/recent-posts');

    get_template_part('template-parts/components/testimonial-slider');

    // Display our Native Gallery Component
    get_template_part('template-parts/components/native-gallery');
    ?>

</main>

<?php
get_footer();