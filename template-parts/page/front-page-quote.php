<?php
/**
 * Front Page Section: Full-width quote/feature section
 *
 * @package Art_Portfolio_Theme
 */

$image_data = get_field('quote_background_image');
$quote_text = get_field('quote_text');
$attribution = get_field('quote_attribution');

// Check if the required fields have data before displaying the section
if ( $image_data && $quote_text ) :
?>
<section class="relative bg-base-300 mt-2">

    <div class="absolute inset-0">
        <img src="<?php echo esc_url($image_data['sizes']['full-width-hero']); ?>"
            alt="<?php echo esc_attr($image_data['alt']); ?>" class="w-full h-full object-cover">
    </div>

    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

    <div class="relative h-[60vh] min-h-[400px] flex items-end">
        <div class="container mx-auto px-4 py-12">
            <div class="max-w-xl text-white">
                <p class="text-2xl lg:text-3xl font-serif leading-tight">
                    &ldquo;<?php echo nl2br(esc_html($quote_text)); ?>&rdquo;
                </p>
                <?php if ( $attribution ) : ?>
                <p class="mt-4 text-lg text-white/80">&mdash; <?php echo esc_html($attribution); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php 
endif; 
?>