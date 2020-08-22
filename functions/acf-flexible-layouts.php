<?php

function _wpbc_get_flexible_layouts(){
	$layouts = array( 
		'ui-box-full-cover',
		'ui-subscriptions', 
		'ui-headline', 
		'ui-headline-4-cols', 
		'ui-headline-3-cols', 
	);
	return $layouts;
}

$layouts = _wpbc_get_flexible_layouts();
foreach ($layouts as $layout) {
	include('acf-flexible-layouts/'.$layout.'.php'); 
}

function WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id){
	$sub_prefix = 'field_'.$layout_prefix.'__'; 

	// get section titles
	$section_title = get_sub_field($sub_prefix.'section-title', $post_id);
	$section_subtitle = get_sub_field($sub_prefix.'section-subtitle', $post_id);

	// get/generate section_id 
	if( !empty( get_sub_field($sub_prefix.'section-id', $post_id) ) ){
		$section_id = sanitize_title($section_id);
	}else{
		$section_id = !empty($section_title) ? sanitize_title($section_title) : $layout_prefix.'-'.uniqid();
	}

	// get section options
	$section_options = get_sub_field($sub_prefix.'section_options', $post_id);
		$section_options_style = $section_options[$layout_prefix.'__section_options_style'];
		$section_options_visible = $section_options[$layout_prefix.'__section_options_visible'];

		$section_options_style_color = 'white';

		if( in_array( $section_options_style, array( 'secondary', 'white', 'light' ) )){
			$section_options_style_color = 'primary';
		} 

		$section_background_image = $section_options[$layout_prefix.'__section_options_background_image'];

	return array(
		'section_title' => $section_title,
		'section_subtitle' => $section_subtitle,
		'section_id' => $section_id,
		'section_style_background' => $section_options_style,
		'section_style_color' => $section_options_style_color,
		'section_background_image' => $section_background_image,
		'section_visible' => $section_options_visible,
	);
} 

function WPBC_acf_make_flexible_content_layout($args=array(), $layouts=array()){

	if(empty($args)) return; 

		$layout_name = !empty($args['layout_name']) ? $args['layout_name'] : 'ui-box-test';
		$layout_label = !empty($args['layout_label']) ? $args['layout_label'] : 'Box Test';
		$sub_fields = array();

		$sub_fields[] = WPBC_acf_make_tab_field(
			array(
				'key' => $layout_name.'__content_tab',
				'label' => 'Contenido',
				'placement' => 'top',
			)
		);
			if(empty($args['hide_section_title'])){
				$sub_fields[] = WPBC_acf_make_text_field(
					array(
						'name' => $layout_name.'__section-title',
						'label'=>'Título de sección', 
						'class' => 'acf-input-title', 
						'width' => '70%',
					)
				);
			}
			if(empty($args['hide_section_title'])){
				$sub_fields[] = WPBC_acf_make_text_field(
					array(
						'name' => $layout_name.'__section-subtitle',
						'label'=>'Sub título (opcional)', 
						'class' => '', 
						'width' => '70%',
					)
				);
			}

			$content_sub_fields = $args['content_sub_fields'];
			if(!empty($content_sub_fields)){
				foreach ($content_sub_fields as $key => $value) {
					$sub_fields[] = $value;
				}
			}

		if(empty($args['hide_call_to_action'])){

				$sub_fields[] = WPBC_acf_make_tab_field(
					array(
						'key' => $layout_name.'__call_to_action_tab',
						'label'=>_x('Call to Action', 'bootclean'),
						'placement' => 'top',
					)
				);

					$sub_fields[] = WPBC_acf_make_call_to_action_group_field(
						array(
							'name' => $layout_name.'__call_to_action',
							'label'=> 'Método de visualización', 
							'default_type' => 'btn',
						)
					);

			}

		$sub_fields[] = WPBC_acf_make_tab_field(
			array(
				'key' => $layout_name.'__section_options_tab',
				'label'=>_x('Settings', 'bootclean'),
				'placement' => 'top',
			)
		); 

			$sub_fields_section_options = array();


				if(empty($args['hide_options_style'])){

					$sub_fields_section_options[] = WPBC_acf_make_text_field(
						array(
							'name' => $layout_name.'__section-id',
							'label'=>'ID de sección', 
							'class' => '', 
							'width' => '20%',
						)
					);

					$def_color = 'transparent'; 
					$sub_fields_section_options[] = WPBC_acf_make_radio_field( array(
								'name' => $layout_name.'__section_options_style',
								'label'=>  'Esquema de color',
								'choices' => WPBC_get_acf_root_colors_choices($layout_name.'__section_options_style'),
								'default_value' => $def_color,
								'width' => '20%',
								'class' => 'wpbc-radio-as-btn no-padding-radio-label', 
							) );

					} 

					$sub_fields_section_options[] = WPBC_acf_make_image_field(
						array(
							'name' => $layout_name.'__section_options_background_image',
							'label'=>'Imagen de fondo', 
							'width' => '40%', 
						)
					);

					$sub_fields_section_options[] = WPBC_acf_make_true_false_field(
							array(
								'name' => $layout_name.'__section_options_visible',
								'label'=>'¿Ocultar la sección?',  
								'default_value' => 0, 
								'message' => '',
								'width' => '20%', 
							)
						); 

					$sub_fields[] = WPBC_acf_make_group_field(
						array(
							'name' => $layout_name.'__section_options',
							'label'=>'',  
							'width' => '100%',
							'sub_fields' => $sub_fields_section_options,
							'class' => 'wpbc-group-no-border wpbc-group-no-label',
						)
					); 

		$layouts['layout_'.$layout_name] = array(
			'key' => 'layout_'.$layout_name,
			'name' => $layout_name,
			'label' => $layout_label,
			'display' => 'block',
			'sub_fields' => $sub_fields,
			'min' => '',
			'max' => '',
		); 

		return $layouts; 

}

add_filter('acf/fields/flexible_content/layout_title', function($title, $field, $layout, $i){

	$check = _wpbc_get_flexible_layouts();
	if( in_array($layout['name'], $check) ){

		if( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX && isset($_POST['value']) ){ 
			// code to handle the AJAX
    	$value = $_POST['value'];  
    }else{
    	// code normal php load
    	$value = !empty($field['value'][$i]) ? $field['value'][$i] : '';
    }

    $t = '';

    if(!empty($value)){ 

    	if(!empty($value['field_'.$layout['name'].'__section-title'])){
    		$t = $value['field_'.$layout['name'].'__section-title']; 
    		$title = '<small class="wpbc-badge" style="background-color:#007bff">'.$title.'</small> '.$t;
    	}
    	
    	$section_options = !empty($value['field_'.$layout['name'].'__section_options']) ? $value['field_'.$layout['name'].'__section_options'] : '';

    	$layout_style = !empty($section_options['field_'.$layout['name'].'__section_options_style']) ? $section_options['field_'.$layout['name'].'__section_options_style'] : '';  
    	
    	if(!empty($layout_style)){
				$title = '<small title="Esquema de color" style="background-color:var(--'.$layout_style.');" class="wpbc-badge wpbc-badge-style bg-'.$layout_style.'">'.$layout_styl.'</small> ' . $title;
    	}

    }

	}

	return $title;

}, 10, 4); 

add_action('admin_head',function(){
	$check = _wpbc_get_flexible_layouts();
	?>
<style>
<?php foreach ($check as $value) { ?>
	.acf-tooltip [data-layout="<?php echo $value; ?>"] .dot-badge{
		background-color:#007bff;
		width: 10px;
		height: 10px;
		display: inline-block;
		border-radius: 100%;
		margin-right: 4px;
		border: 1px solid #fff;
		vertical-align: -1px;
	}
	.wpbc-badge-style{
		position: relative;
		border: 1px solid rgba(1,1,1,.2);
		display: inline-block;
		height: 10px;
		padding: 0;
		width: 10px;
		top: 2px;
		cursor: default;
	} 
<?php } ?>
</style>
	<?php
}); 