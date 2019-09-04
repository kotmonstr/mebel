<?php
$options = get_option( 'map_api_settings' );
$title =  $options['map_api_text_field_0'];
$iframeCode =  $options['map_api_text_field_1'];
?>

<div class="fusion-fullwidth ">
    <h1 style="text-align: center"><?php echo $title ?></h1>
	<?php echo $iframeCode ?>
</div>
