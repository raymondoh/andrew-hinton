<?php
/**
 * Portfolio Filters Component
 * This definitive version adds 'bg-none' to remove the custom DaisyUI arrow.
 *
 * @package Art_Portfolio_Theme
 */

$mediums = $args['mediums'] ?? [];
?>

<?php if ( ! is_wp_error( $mediums ) && ! empty( $mediums ) ) : ?>
<div class="filter-dropdown-container relative max-w-xs ">

    <select class="select select-primary select-bordered  appearance-none bg-none select-md" x-model="activeFilter"
        @change="filter($event.target.value)">

        <option value="all">All Work</option>

        <?php foreach ( $mediums as $medium ) : ?>
        <option value="<?php echo esc_attr($medium->slug); ?>">
            <?php echo esc_html($medium->name); ?>
        </option>
        <?php endforeach; ?>

    </select>

    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-base-content">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </div>
</div>
<?php endif; ?>