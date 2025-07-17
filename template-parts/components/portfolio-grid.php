<?php
/**
 * Final Portfolio Grid Component
 * A robust, unified component with a persistent hero, AJAX filters, and a "Load More" button.
 *
 * @package Art_Portfolio_Theme
 */

$posts_per_page = 12; // Set how many images to show per page/load
$args = array(
    'post_type'      => 'artwork',
    'posts_per_page' => $posts_per_page,
);
$artwork_query = new WP_Query($args);
$mediums = get_terms( array('taxonomy' => 'medium', 'hide_empty' => true) );

// Get the ID of the current page to fetch its featured image for the hero
$page_id = get_queried_object_id();
?>

<?php if ( $artwork_query->have_posts() ) : ?>
<section class="portfolio-component" x-data="{
        loading: false,
        page: 1,
        maxPages: <?php echo $artwork_query->max_num_pages; ?>,
        activeFilter: 'all',

        // This function handles loading posts for both filters and the 'Load More' button
        loadPosts(replace = false) {
            this.loading = true;
            let formData = new FormData();
            formData.append('action', 'filter_and_load_artworks');
            formData.append('page', this.page);
            formData.append('medium', this.activeFilter);
            formData.append('security', my_theme_ajax_obj.nonce); // Security nonce from your plugin

            fetch(my_theme_ajax_obj.ajax_url, { method: 'POST', body: formData })
            .then(response => response.json())
            .then(response => {
                if(response.success) {
                    const grid = this.$refs.gridContainer;
                    if (replace) {
                        grid.innerHTML = ''; // Clear the grid if it's a new filter
                    }
                    grid.insertAdjacentHTML('beforeend', response.data.html);
                    this.maxPages = response.data.maxPages;
                    this.$dispatch('posts-loaded'); // For re-initializing the lightbox
                } else {
                    if (replace) { grid.innerHTML = '<p class=\'col-span-full text-center\'>No artwork found for this filter.</p>'; }
                    this.maxPages = 0; // No more pages to load
                }
                this.loading = false;
            });
        },
        
        // This function is called when a filter button is clicked
        filter(mediumSlug) {
            this.activeFilter = mediumSlug;
            this.page = 1;
            this.loadPosts(true); // `true` tells loadPosts to replace the content
        },
        
        // This function is called when the 'Load More' button is clicked
        loadMore() {
            if (this.page < this.maxPages) {
                this.page++;
                this.loadPosts(false); // `false` tells loadPosts to append the content
            }
        }
    }">

    <?php if ( has_post_thumbnail($page_id) ) : ?>
    <?php if ( has_post_thumbnail($page_id) ) : ?>
    <div class="relative bg-base-300">
        <div class="absolute inset-0">
            <?php echo get_the_post_thumbnail($page_id, 'full', array('class' => 'w-full h-full object-cover')); ?>
        </div>
        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative container mx-auto px-4 py-24 md:py-32">
            <?php 
                // This single line replaces all the old filter button code
                get_template_part('template-parts/components/portfolio-filters', null, array(
                    'mediums' => $mediums
                )); 
                ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>


    <div class="container mx-auto px-4 mt-16">
        <div id="portfolio-grid-container" x-ref="gridContainer"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
            <?php
            // This loop now only displays the VERY FIRST page of posts
            while ( $artwork_query->have_posts() ) : $artwork_query->the_post();
                get_template_part('template-parts/content/content-artwork-card');
            endwhile; 
            ?>
        </div>

        <div class="load-more-container text-center mt-12">
            <button x-show="page < maxPages" @click="loadMore()" :disabled="loading" class="btn btn-outline btn-sm">
                <span x-show="!loading">Load More</span>
                <span x-show="loading" class="loading loading-spinner"></span>
            </button>
        </div>
    </div>
</section>

<?php 
endif; 
wp_reset_postdata(); 
?>