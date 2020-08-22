<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_headline',10,1);

function build_ui_headline($layouts){

	$pre_fix = 'ui-headline';

	$sub_fields = array();  

		$sub_fields[] = WPBC_acf_make_wysiwyg_field(
			array(
				'name' => $pre_fix.'__'.'content',
				'label'=>'Contenido (opcional)', 
				'width' => '100%', 
			)
		);  

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => $pre_fix,
		'layout_label' => '<i class="dot-badge"></i> Encabezado/Contenido',
		'content_sub_fields' => $sub_fields,
		'hide_call_to_action' => true,
	), $layouts); 

	return $layouts; 
} 