<?php 

/* Add a reusable field to use on some flexible layouts settings */
add_filter('WPBC_acf_reusables_fields', function($fields){ 
		$fields[] = array (
			'key' => 'field_reusable_visible_conditional',
			'label' => 'Ocultar para Clientes',
			'name' => 'reusable_visible_conditional',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'wpbc-true_false-ui',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		);
		return $fields;

	},20,1);

/* Add the reusable into "template_part_row" layout */

add_filter('WPBC_group_builder__layout_template_part_row_clone', function($clone){
	//$clone[8] = 'field_reusable_visible_conditional';
	$clone = array(
		0 => 'key__r_tab__content',
		1 => 'key__r_wpbc_template_part', // The reusable added
		2 => 'key__r_wpbc_template_part_args', // The reusable added
		3 => 'key__r_wpbc_template_args', // The reusable added
		4 => 'key__r_tab__settings',
		5 => 'key__r_builder_classes_group',
		6 => 'key__r_tab__advanced',
		7 => 'field_reusable_visible_conditional',  // replaced (original key__r_wpbc__advanced_group_inview)
	);
  return $clone;
},10,1);

/* Add the reusable into "html_row" layout */

add_filter('WPBC_group_builder__layout_html_row_clone', function($clone){
	//$clone[8] = 'field_reusable_visible_conditional';
	$clone = array(
		0 => 'key__r_tab__content',
		1 => 'key__r_html_code',
		2 => 'key__r_tab__settings',
		3 => 'key__r_builder_classes_group',
		4 => 'key__r_tab__advanced', // added
		5 => 'field_reusable_visible_conditional',  // added
	);
  return $clone;
},10,1);


/* All flexible layouts should be here listed, also they should have the same name file for the back and font-end */

function _wpbc_get_flexible_layouts(){
	$layouts = array( 
		'ui-box-full-cover',
		'ui-box-full-cover-html',
		'ui-subscriptions', 
		'ui-headline', 
		
		'ui-headline-4-cols', 
		'ui-headline-3-cols', 
		'ui-slider-rows', 
		'ui-free-tour',  

		'ui-box-content-2-cols', 

		'ui-slider-testimonios', 

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
	$section_id = !empty($section_title) ? sanitize_title($section_title) : $layout_prefix.'-'.uniqid();

	// get section options
	$section_options = get_sub_field($sub_prefix.'section_options', $post_id);

		// get section id used on setting options if used
		if(!empty($section_options[$layout_prefix.'__section-id'])){
			$section_id = $section_options[$layout_prefix.'__section-id'];
		}
		$section_options_style = $section_options[$layout_prefix.'__section_options_style'];
		$section_options_visible = $section_options[$layout_prefix.'__section_options_visible'];

		$section_options_style_color = 'white';

		if( in_array( $section_options_style, array( 'secondary', 'white', 'light' ) )){
			$section_options_style_color = 'primary';
		} 

		$section_background_image = $section_options[$layout_prefix.'__section_options_background_image'];
 
		$section_visible_conditional = get_sub_field($sub_prefix.'section_visible_conditional', $post_id);

		$section_visible_subscriber = get_sub_field($sub_prefix.'section_visible_subscriber', $post_id);

		$user_status = WPBC_detect_user_status();
		if($user_status!='administrator'){

			if($section_visible_conditional){ 
				// $section_options_visible = apply_filters('wpbc/flexible/layouts/section_visible'); 
				if( is_user_logged_in() ){
					$user_id = get_current_user_id();
					$section_options_visible = true; // that is hidde it
				}

			}
			if($section_visible_subscriber){ 
				if( is_user_logged_in() ){
					$user_id = get_current_user_id();
					$subscription_active = wcs_user_has_subscription( $user_id, '', 'active' ); 
					if( $user_status == 'customer_on_hold' ){
						$section_options_visible = true; // that is hidde it
					}
				}
			}

		}

	return array(
		'section_title' => $section_title,
		'section_subtitle' => $section_subtitle,
		'section_id' => $section_id,
		'section_style_background' => $section_options_style,
		'section_style_color' => $section_options_style_color,
		'section_background_image' => $section_background_image,
		'section_visible' => $section_options_visible,
		'section_visible_conditional' => $section_visible_conditional,
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
				$sub_fields[] = WPBC_acf_make_textarea_field(
					array(
						'name' => $layout_name.'__section-title',
						'label'=>'Título de sección', 
						'class' => 'acf-input-title', 
						'width' => '70%',
					)
				);
			}
			if(empty($args['hide_section_subtitle'])){
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


			$sub_fields[] = WPBC_acf_make_tab_field(
				array(
					'key' => $layout_name.'__section_advanced_tab',
					'label'=>_x('Advanced', 'bootclean'),
					'placement' => 'top',
				)
			); 

				$sub_fields[] = WPBC_acf_make_true_false_field(
							array(
								'name' => $layout_name.'__section_visible_conditional',
								'label'=>'Ocultar para Clientes',  
								'default_value' => 0, 
								'message' => '',
								'width' => '20%', 
							)
						); 

				$sub_fields[] = WPBC_acf_make_true_false_field(
							array(
								'name' => $layout_name.'__section_visible_subscriber',
								'label'=>'Ocultar para Subscriptores Activos',  
								'default_value' => 0, 
								'message' => '',
								'width' => '40%', 
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