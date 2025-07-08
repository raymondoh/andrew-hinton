<?php
/**
 * Final, Robust Portfolio Grid Component
 *
 * @package Art_Portfolio_Theme
 */

$posts_per_page = 4; // Your setting of 4 posts per page

$args = array(
    'post_type'      => 'artwork',
    'posts_per_page' => $posts_per_page,
);
$artwork_query = new WP_Query($args);
$mediums = get_terms( array('taxonomy' => 'medium', 'hide_empty' => true) );
?>

<?php if ( $artwork_query->have_posts() ) : ?>
<section class="portfolio-component fade-in-element" x-data="{
        inView: false, // For the fade-in animation
        loading: false,
        page: 1,
        maxPages: <?php echo $artwork_query->max_num_pages; ?>,
        activeFilter: 'all',

        // This function now only loads posts and dispatches our custom event.
        loadPosts(replace = false) {
            this.loading = true;
            let formData = new FormData();
            formData.append('action', 'filter_and_load_artworks');
            formData.append('page', this.page);
            formData.append('medium', this.activeFilter);
            formData.append('security', my_theme_ajax_obj.nonce);

            fetch(my_theme_ajax_obj.ajax_url, { method: 'POST', body: formData })
            .then(response => response.json())
            .then(response => {
                if(response.success) {
                    const grid = this.$refs.gridContainer;
                    if (replace) {
                        grid.innerHTML = '';
                    }
                    grid.insertAdjacentHTML('beforeend', response.data.html);
                    this.maxPages = response.data.maxPages;
                    
                    // SHOUT the custom event for our main.js file to hear
                    this.$dispatch('posts-loaded');

                } else {
                    if (replace) { grid.innerHTML = '<p class=\'col-span-full text-center\'>No artwork found.</p>'; }
                    this.maxPages = 0;
                }
                this.loading = false;
            });
        },
        
        filter(mediumSlug) { this.activeFilter = mediumSlug; this.page = 1; this.loadPosts(true); },
        loadMore() { if (this.page < this.maxPages) { this.page++; this.loadPosts(false); } }
    }" x-intersect:enter="inView = true" :class="{ 'is-visible': inView }">
    <div class="container mx-auto px-4">
        <?php if ( ! is_wp_error( $mediums ) && ! empty( $mediums ) ) : ?>
        <div class="filter-buttons flex justify-center flex-wrap gap-2 mb-12">
            <button @click="filter('all')"
                :class="{ 'btn-primary': activeFilter === 'all', 'btn-ghost': activeFilter !== 'all' }" class="btn">All
                Work</button>
            <?php foreach ( $mediums as $medium ) : ?>
            <button @click="filter('<?php echo esc_attr($medium->slug); ?>')"
                :class="{ 'btn-primary': activeFilter === '<?php echo esc_attr($medium->slug); ?>', 'btn-ghost': activeFilter !== '<?php echo esc_attr($medium->slug); ?>' }"
                class="btn"><?php echo esc_html($medium->name); ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div id="portfolio-grid-container" x-ref="gridContainer"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php
            while ( $artwork_query->have_posts() ) : $artwork_query->the_post();
                get_template_part('template-parts/content/content-artwork-card');
            endwhile; 
            ?>
        </div>

        <div class="load-more-container text-center mt-12">
            <button x-show="page < maxPages" @click="loadMore()" :disabled="loading" class="btn btn-primary btn-wide">
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