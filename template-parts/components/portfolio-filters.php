<?php
/**
 * Portfolio Filters Component
 * This is the new dropdown/select version for a cleaner UI.
 *
 * @package Art_Portfolio_Theme
 */

$mediums = $args['mediums'] ?? [];
?>

<?php if ( ! is_wp_error( $mediums ) && ! empty( $mediums ) ) : ?>
<div class="filter-dropdown-container max-w-xs mx-auto">

    <select class="select select-bordered w-full" x-model="activeFilter" @change="filter($event.target.value)">

        <option value="all">All Work</option>

        <?php foreach ( $mediums as $medium ) : ?>
        <option value="<?php echo esc_attr($medium->slug); ?>">
            <?php echo esc_html($medium->name); ?>
        </option>
        <?php endforeach; ?>

    </select>
</div>
<?php endif; ?>