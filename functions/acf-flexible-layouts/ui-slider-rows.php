<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_slider_rows',10,1);

function build_ui_slider_rows($layouts){

	$pre_fix = 'ui-slider-rows';

	$sub_fields = array();  

		$sub_fields_items = array();

			$sub_fields_items[] = WPBC_acf_make_image_field(array(
				'name' => $pre_fix.'__'.'item_image',
				'label' => 'Imagen',
				'width' => '30%',
			));
			$sub_fields_items[] = WPBC_acf_make_text_field(array(
				'name' => $pre_fix.'__'.'item_label',
				'label' => 'Texto',
				'width' => '70%',
			));

		$sub_fields[] = WPBC_acf_make_repeater_field(
			array(
				'name' => $pre_fix.'__'.'items',
				'label'=>'Items del slider', 
				'width' => '100%', 
				'button_label' => 'Agregar Item',
				'sub_fields' => $sub_fields_items,
			)
		);  

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => $pre_fix,
		'layout_label' => '<i class="dot-badge"></i> Slider en filas',
		'content_sub_fields' => $sub_fields,
		'hide_call_to_action' => true,
		'hide_section_subtitle' => true,
	), $layouts); 

	return $layouts; 
} 