<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_subscriptions',10,1);

function build_ui_subscriptions($layouts){

	$pre_fix = 'ui-subscriptions';

	$sub_fields = array();  

		$sub_fields[] = WPBC_acf_make_message_field(
			array(
				'key' => $pre_fix.'__subscriptions_description',
				'label' => 'Selecciona el producto que se usará en cada caja.',
				'message' => '<small>Las posiciones aplican solo para pantallas grandes. En móbiles aparecerán una debajo de la otra.</small>',
			)
		);

		$sub_fields[] = WPBC_acf_make_post_object_wpbc_template(
			array(
				'name' => $pre_fix.'__'.'membresia_left_post',
				'post_type' => array( 'product' ),
				'label'=>'Caja Izquierda', 
				'width' => '33%', 
			)
		);

		$sub_fields[] = WPBC_acf_make_post_object_wpbc_template(
			array(
				'name' => $pre_fix.'__'.'membresia_center_post',
				'post_type' => array( 'product' ),
				'label'=>'Caja Central (Destacada)', 
				'width' => '33%', 
			)
		);

		$sub_fields[] = WPBC_acf_make_post_object_wpbc_template(
			array(
				'name' => $pre_fix.'__'.'membresia_right_post',
				'post_type' => array( 'product' ),
				'label'=>'Caja Derecha', 
				'width' => '33%', 
			)
		); 

		$sub_fields[] = WPBC_acf_make_codemirror_field(
			array(
				'name' => $pre_fix.'__'.'membresia_footer_html',
				'label'=>'Contenido al pié (opcional)', 
				'width' => '100%', 
			)
		);
 

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => $pre_fix,
		'layout_label' => '<i class="dot-badge"></i> Subscripciones',
		'content_sub_fields' => $sub_fields,
		'hide_call_to_action' => true,
	), $layouts); 

	return $layouts; 
} 