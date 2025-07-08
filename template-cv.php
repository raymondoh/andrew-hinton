<?php
/**
 * Template Name: CV Page
 * This version uses the user-requested accordion style from DaisyUI documentation.
 *
 * @package Art_Portfolio_Theme
 */

get_header(); ?>

<div class="container mx-auto">
    <header class="page-header mb-12 text-center">
        <h1 class="text-4xl font-bold tracking-tight text-base-content sm:text-5xl"><?php the_title(); ?></h1>
    </header>

    <div class="max-w-4xl mx-auto space-y-2">
        <?php
        $exhibitions_query = new WP_Query([
            'post_type'      => 'exhibition',
            'posts_per_page' => -1,
            'meta_key'       => 'event_date',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC',
        ]);

        if ($exhibitions_query->have_posts()) :
            $grouped_posts = [];
            while ($exhibitions_query->have_posts()) : $exhibitions_query->the_post();
                $year = get_field('event_date');
                if ($year) {
                    $grouped_posts[$year][] = get_post();
                }
            endwhile;
            wp_reset_postdata();
            krsort($grouped_posts);

            $is_first_item = true;

            foreach ($grouped_posts as $year => $posts) :
            ?>
        <div class="collapse collapse-plus bg-base-100 border border-base-300 rounded-lg">
            <input type="radio" name="cv-accordion" <?php if ($is_first_item) { echo 'checked="checked"'; } ?> />

            <div class="collapse-title font-semibold text-xl">
                <?php echo esc_html($year); ?>
            </div>

            <div class="collapse-content">
                <ul class="space-y-4 pt-2">
                    <?php foreach ($posts as $post) : setup_postdata($post); ?>
                    <li class="cv-entry">
                        <h3 class="text-lg font-semibold text-base-content"><?php the_title(); ?></h3>
                        <?php if ( get_field('detail') ) : ?>
                        <div class="prose prose-sm max-w-none text-base-content/80 mt-1">
                            <?php the_field('detail'); ?>
                        </div>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php
                $is_first_item = false;
            endforeach;
            
            wp_reset_postdata();
        else :
            echo '<p class="text-center">No CV entries found.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>