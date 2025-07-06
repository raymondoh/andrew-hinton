<?php
/**
 * The template for displaying the front page (which is the portfolio).
 *
 * @package Art_Portfolio_Theme
 */

get_header(); 
?>

<main id="main" class="site-main site-content" role="main">
    <?php
    get_template_part('template-parts/components/portfolio-grid');
    ?>
</main>

<?php
get_footer();