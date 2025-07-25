<?php
/**
 * Final Portfolio Grid Component
 * This definitive version places the quote in the hero and moves the filters
 * to the top-right of the grid for a cleaner, more professional layout.
 * It also ensures the quote text is light and readable.
 *
 * @package Art_Portfolio_Theme
 */

$initial_query = new WP_Query([
    'post_type'      => 'artwork',
    'posts_per_page' => 12,
]);
$mediums = get_terms( ['taxonomy' => 'medium', 'hide_empty' => true] );
$page_id = get_queried_object_id();
?>

<section class="portfolio-component" x-data="{
        loading: false,
        page: 1,
        maxPages: <?php echo $initial_query->max_num_pages; ?>,
        activeFilter: new URLSearchParams(window.location.search).get('filter') || 'all',

        loadPosts(replace = false) {
            this.loading = true;
            let formData = new FormData();
            formData.append('action', 'filter_and_load_artworks');
            formData.append('page', this.page);
            formData.append('medium', this.activeFilter);
            formData.append('security', hinton_portfolio_ajax_obj.nonce);

            fetch(hinton_portfolio_ajax_obj.ajax_url, { method: 'POST', body: formData })
            .then(response => response.json())
            .then(response => {
                if(response.success) {
                    const grid = this.$refs.gridContainer;
                    if (replace) { grid.innerHTML = ''; }
                    grid.insertAdjacentHTML('beforeend', response.data.html);
                    this.maxPages = response.data.maxPages;
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
    }" x-init="if (activeFilter !== 'all') { loadPosts(true); }">

    <?php if ( has_post_thumbnail($page_id) ) : ?>
    <!-- The Hero section now ONLY contains the quote -->
    <div class="relative bg-base-300 h-[10vh] min-h-[250px]">
        <div class="absolute inset-0">
            <?php echo get_the_post_thumbnail($page_id, 'full', array('class' => 'w-full h-full object-cover')); ?>
        </div>
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative h-full flex flex-col items-center justify-center text-center p-4">
            <?php
            $quote = get_field('quote_text', $page_id);
            if ( $quote ) :
            ?>
            <!-- MODIFICATION: Replaced 'prose-invert' with a direct text color class -->
            <blockquote class="prose prose-xl lg:prose-2xl italic max-w-3xl mx-auto text-white/90">
                <?php echo esc_html( $quote ); ?>
            </blockquote>
            <?php
            endif;
            ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="container mx-auto px-4 mt-4 md:mt-6 lg:mt-12">

        <!-- New container for the filters -->
        <div class="controls-container flex justify-end mt-8 mb-8">
            <?php 
                // The filters are now here, outside the hero and aligned to the right.
                get_template_part('template-parts/components/portfolio-filters', null, ['mediums' => $mediums]); 
            ?>
        </div>

        <div id="portfolio-grid-container" x-ref="gridContainer"
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 min-h-[500px]">

            <?php
            // The initial grid of posts
            while ( $initial_query->have_posts() ) : $initial_query->the_post();
                get_template_part('template-parts/content/content-artwork-card');
            endwhile; 
            ?>
        </div>

        <div class="load-more-container text-center mt-12 mb-12">
            <!-- This button's classes are unchanged and should be correct -->
            <button x-show="!loading && page < maxPages" @click="loadMore()" class="btn btn-primary btn-wide">
                <span>Load More</span>
            </button>
            <div x-show="loading" class="text-center">
                <span class="loading loading-spinner loading-lg"></span>
            </div>
        </div>
    </div>
</section>

<?php 
wp_reset_postdata(); 
?>