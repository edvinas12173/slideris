<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'btn-' . $block['id'];
if( !empty($block['anchor']) )
    $id = $block['anchor'];

// Create class attribute allowing for custom "className" and "align" values.
$className = 'btn';
if ( !empty($block['className']) )
    $className .= ' ' . $block['className'];

if ( !empty($block['align']) )
    $className .= ' align' . $block['align'];

// Load values and assign defaults.
$link       = get_field('link');
$label      = get_field('label');
$target     = get_field('open_in_new_tab') ? "target=\"blank\"" : '';

if (!$link || !$label)
    return;
?>
<a id="<?php echo esc_attr($id); ?>"
    class="<?php echo esc_attr($className); ?>"
    href="<?php echo $link ?>"
    <?php echo $target ?>>
    <?php echo $label ?>
</a>
