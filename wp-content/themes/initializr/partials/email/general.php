<?php
namespace App;

get_template_part('partials/email/header');
$data = get_query_var('template_data');

?>

<tr class="email-body">
    <td><?php echo $data['message']; ?></td>
</tr>

<?php get_template_part('partials/email/footer'); ?>
