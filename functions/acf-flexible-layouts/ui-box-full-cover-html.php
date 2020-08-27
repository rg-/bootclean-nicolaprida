<?php

add_filter('WPBC_acf_builder_layouts', 'build_ui_box_full_cover_html',10,1);

function build_ui_box_full_cover_html($layouts){

	$pre_fix = 'ui-box-full-cover-html';

	$sub_fields = array();  

		$sub_fields[] = WPBC_acf_make_codemirror_field(
				array(
					'name' => $pre_fix.'__'.'content',
					'label'=>'Contenido Html',  
				)
			);

		$sub_fields[] = WPBC_acf_make_gallery_advanced_field(
			array(
				'name' => $pre_fix.'__'.'content_images',
				'label'=> 'Imagen/es de fondo',
				'class' => 'acf-small-gallery', 
				'columns' => 6, 
				'width' => '70%',
			)
		); 
		
		$content_options_fields = array(); 

			$content_options_fields[] = WPBC_acf_make_radio_field( array(
				'name' => $pre_fix.'__'.'content_options_side',
				'label'=>  'Posición del contendio', 
				'choices' => array(
					'left' => 'Izquierda', 'right' => 'Derecha'
				),
				'default_value' => 'left',
				'class' => 'wpbc-radio-as-btn as-btn-sm as-btn-secondary'
			) ); 


		$sub_fields[] = WPBC_acf_make_group_field(
			array(
				'name' => $pre_fix.'__'.'content_options',
				'label'=> 'Opciones', 
				'class' => '',   
				'sub_fields' => $content_options_fields,
				'width' => '30%',
			)
		);  

	$layouts = WPBC_acf_make_flexible_content_layout(array(
		'layout_name' => $pre_fix,
		'layout_label' => '<i class="dot-badge"></i> Fondo/Html',
		'content_sub_fields' => $sub_fields,
		'hide_call_to_action' => true,
		'hide_section_title' => true,
		'hide_section_subtitle' => true,
	), $layouts); 

	return $layouts; 
} 