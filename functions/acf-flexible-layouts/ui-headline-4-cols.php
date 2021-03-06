<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_headline_4_cols',10,1);

function build_ui_headline_4_cols($layouts){

	$pre_fix = 'ui-headline-4-cols';

	$sub_fields = array();  

		$sub_fields[] = WPBC_acf_make_wysiwyg_field(
			array(
				'name' => $pre_fix.'__'.'content',
				'label'=>'Contenido (opcional)', 
				'width' => '100%', 
			)
		);  

		$sub_fields[] = WPBC_acf_make_textarea_field(
			array(
				'name' => $pre_fix.'__'.'col_1',
				'label'=>'Columna 1', 
				'width' => '25%', 
			)
		);
		$sub_fields[] = WPBC_acf_make_textarea_field(
			array(
				'name' => $pre_fix.'__'.'col_2',
				'label'=>'Columna 2', 
				'width' => '25%', 
			)
		);
		$sub_fields[] = WPBC_acf_make_textarea_field(
			array(
				'name' => $pre_fix.'__'.'col_3',
				'label'=>'Columna 3', 
				'width' => '25%', 
			)
		);  
		$sub_fields[] = WPBC_acf_make_textarea_field(
			array(
				'name' => $pre_fix.'__'.'col_4',
				'label'=>'Columna 4', 
				'width' => '25%', 
			)
		);  

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => $pre_fix,
		'layout_label' => '<i class="dot-badge"></i> Encabezado/Contenido/4 Cols',
		'content_sub_fields' => $sub_fields,
		'hide_call_to_action' => true,
	), $layouts); 

	return $layouts; 
} 