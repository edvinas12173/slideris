<?php
namespace App;

do_action('theme/enqueueGoogleMapScripts');
$map = get_sub_field('map');
?>
<?php if ($map) : ?>
    <div data-map class="google-map">
        <div data-lat="<?php echo $map['lat'] ?>" data-lng="<?php echo $map['lng'] ?>" class="marker"></div>
    </div>
<?php endif; ?>
