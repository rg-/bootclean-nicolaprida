<?php 
/*

	$post_id passed
	$layout_count passed

*/

$do_shortcode = ''; 
$templates = get_sub_field('key__layout_template_tabs_row__content_'.'key__r_wpbc_template_repeater', $post_id);
$inview = get_sub_field('key__layout_template_tabs_row__content_'.'key__r_wpbc__advanced_group_inview', $post_id);
$use_inview = false; 
if(!empty($inview)){
	
	$advanced_group_inview__type = $inview['advanced_group_inview__type'];
	if($advanced_group_inview__type == 'ajax-load'){
		$type = 'inview';
		$use_inview = true;
	}

}

foreach ($templates as $key => $value) {
	$label = $value['label'];
	$template_id = $value['template_id'];

	// $do_shortcode .= do_shortcode('[WPBC_get_template id="'.$template_id.'" post_id="'.$post_id.'" template_id="'.$post_id.'" from="template_tabs_row" layout_count="'.$layout_count.'"/]');
} 
/*
if($use_inview){ 
	$do_shortcode = do_shortcode('[WPBC_get_template_ajax post_id="'.$post_id.'" args="" template_id="'.$post_id.'" id="'.$template_id.'" type="'.$type.'" from="template_row" is_ajax="true" layout_count="'.$layout_count.'"/]');
}else{ 
	$do_shortcode = do_shortcode('[WPBC_get_template id="'.$template_id.'" post_id="'.$post_id.'" template_id="'.$post_id.'" from="template_row" layout_count="'.$layout_count.'"/]');
}
*/
?>
<div id="tabla-posiciones" class="container gpt-2 gpb-4" data-inview="detect" data-inview-apply="body" data-inview-replaceclass="uielements-" data-inview-replaceto="uielements-white">

	<div class="row gpt-1 gpb-3">
		<div class="col-12">
			<h2 class="section-title text-primary text-center">Tabla de Posiciones</h2>
		</div>
	</div>
	
	<div class="row">
		<div class="col-12">

			<div class="dropdown dropdown-select dropdown-for-tabs d-lg-none">
			  <button class="btn btn-block btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="dropdown-select-value" data-value="0"><?php echo $templates[0]['label']; ?></span> <i class="caret pngicon-down-white"></i>
			  </button>
			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			  	<?php $c = 0; foreach ($templates as $key => $value) {
							$label = $value['label'];
							$slug = sanitize_title($label); ?>
			    <a class="dropdown-item" href="#<?php echo $slug; ?>-tab" data-trigger="onclick" data-value="<?php echo $c; ?>"><?php echo $label; ?></a>
			  	<?php  $c++; } ?>
			  </div>
			</div>

			<div class="d-none d-lg-block">

				<ul class="nav" id="tabla-posiciones-nav" role="tablist">
				  <?php $c = 0; foreach ($templates as $key => $value) {
							$label = $value['label'];
							$slug = sanitize_title($label);
							$active = '';
							$selected = 'false';
							if($c==0){
								$active = 'active';
								$selected = 'true';
							}
							?>
			    <li class="nav-item gmr-1">
				    <a class="btn btn-outline-primary <?php echo $active; ?>" id="<?php echo $slug; ?>-tab" data-toggle="tab" href="#<?php echo $slug; ?>" role="tab" aria-controls="<?php echo $slug; ?>" aria-selected="<?php echo $selected; ?>"><?php echo $label; ?></a>
				  </li>
			  	<?php  $c++; } ?>

				</ul>

			</div>

			<div class="tab-content gmt-1 gmb-2" id="tabla-posiciones-content">
			  	<?php $c = 0; foreach ($templates as $key => $value) {
							$label = $value['label'];
							$template_id = $value['template_id'];
							$slug = sanitize_title($label);
							$active = '';
							$selected = 'false';
							if($c==0){
								$active = 'show active';
								$selected = 'true';
							}
							?>
				  <div class="tab-pane fade <?php echo $active; ?>" id="<?php echo $slug; ?>" role="tabpanel" aria-labelledby="<?php echo $slug; ?>-tab">
						<?php echo do_shortcode('[WPBC_get_template id="'.$template_id.'" post_id="'.$post_id.'" template_id="'.$post_id.'" from="template_tabs_row" layout_count="'.$layout_count.'"/]'); ?>
					</div>
			  	<?php  $c++; } ?>
						
			</div>

		</div>
	</div>

</div>
<?php

$passed_args = array(); 
// echo apply_filters('wpbc/builder/template_tabs_row', $do_shortcode, $post_id, $template_id, $passed_args); 