<?php
/**
 * Portfolio Filters Component
 * This is a reusable component for displaying the artwork medium filters.
 *
 * @package Art_Portfolio_Theme
 */

// These variables are passed from the parent template (portfolio-grid.php)
$mediums = $args['mediums'] ?? [];
?>

<?php if ( ! is_wp_error( $mediums ) && ! empty( $mediums ) ) : ?>
<div class="filter-buttons flex justify-center items-center flex-wrap gap-x-2 gap-y-2 max-w-3xl mx-auto">

    <button @click="filter('all')" :class="{ 'bg-white/20': activeFilter === 'all' }"
        class="btn bg-transparent border-none uppercase tracking-wider rounded-full transition-colors duration-200 text-[11px] text-white hover:bg-white hover:text-black px-4 py-[10px] h-auto min-h-0">All
        Work</button>
    <?php foreach ( $mediums as $medium ) : ?>
    <button @click="filter('<?php echo esc_attr($medium->slug); ?>')"
        :class="{ 'bg-white/20': activeFilter === '<?php echo esc_attr($medium->slug); ?>' }"
        class="btn bg-transparent border-none uppercase tracking-wider rounded-full transition-colors duration-200 text-[11px] text-white hover:bg-white hover:text-black px-4 py-[10px] h-auto min-h-0"><?php echo esc_html($medium->name); ?></button>
    <?php endforeach; ?>
</div>
<?php endif; ?>