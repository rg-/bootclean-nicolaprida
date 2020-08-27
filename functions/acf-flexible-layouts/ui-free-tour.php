<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_free_tour',10,1);

function build_ui_free_tour($layouts){

	$pre_fix = 'ui-free-tour';

	$sub_fields = array();   

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => $pre_fix,
		'layout_label' => '<i class="dot-badge"></i> Slider contenido Publico',
		'content_sub_fields' => $sub_fields,
		'hide_call_to_action' => true, 
	), $layouts); 

	return $layouts; 
} 