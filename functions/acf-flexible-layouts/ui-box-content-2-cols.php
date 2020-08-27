<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_box_content_2_cols',10,1);

function build_ui_box_content_2_cols($layouts){

	$pre_fix = 'ui-box-content-2-cols';

	$sub_fields = array();  

		$sub_fields_items = array();

			$sub_fields_items[] = WPBC_acf_make_image_field(array(
				'name' => $pre_fix.'__'.'item_image',
				'label' => 'Imagen',
				'width' => '30%',
			));
			$sub_fields_items[] = WPBC_acf_make_text_field(array(
				'name' => $pre_fix.'__'.'item_title',
				'label' => 'Título',
				'width' => '70%',
			));
			$sub_fields_items[] = WPBC_acf_make_wysiwyg_field(array(
				'name' => $pre_fix.'__'.'item_content',
				'label' => 'Contenido',
				'width' => '100%',
			));

		$sub_fields[] = WPBC_acf_make_repeater_field(
			array(
				'name' => $pre_fix.'__'.'items',
				'label'=>'Contenidos', 
				'width' => '100%', 
				'button_label' => 'Agregar Item',
				'sub_fields' => $sub_fields_items,
			)
		);  

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => $pre_fix,
		'layout_label' => '<i class="dot-badge"></i> Encabezado + Filas Contenido',
		'content_sub_fields' => $sub_fields,
		'hide_call_to_action' => true, 
	), $layouts); 

	return $layouts; 
} 