<?php
$attachId = $this->get('image');
echo wp_get_attachment_image($attachId, 'medium');
?>
