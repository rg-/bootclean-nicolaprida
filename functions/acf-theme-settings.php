<?php

/*

	Add custom options page for this theme only

*/

if( function_exists('acf_add_options_page') ) {
	
	$location_value = 'nicolaprida-settings'; 

	$args = array(
		'page_title' => __('Nico Laprida Settings','nicolaprida'),
		'menu_slug' => $location_value,
		'capability' => 'edit_theme_options',
	);
	
	acf_add_options_page($args); 


	$fields = array(); 

	// BLOG
	$fields[] = array (
		'key' => 'field_settings_rutinas',
		'label' => __('Paginas de Rutinas','nicolaprida'),
		'name' => 'settings_rutinas',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array ( 

			array(
				'key' => 'field_rutinas_front_page',
				'label' => __('Portada de Rutinas','nicolaprida'),
				'name' => 'rutinas_front_page',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),

			array(
				'key' => 'field_rutinas_layout_header_template',
				'label' => __('Cabezal de Rutinas Singular','nicolaprida'),
				'name' => 'rutinas_layout_header_template',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'wpbc_template',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),

			array(
				'key' => 'field_featured_rutinas',
				'label' => __('Rutinas Destacadas','nicolaprida'),
				'name' => 'featured_rutinas',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'post',
				),
				'taxonomy' => array(
				),
				'allow_null' => 1,
				'multiple' => 1,
				'return_format' => 'id',
				'ui' => 1,
			),
		)
	);

	// VIDEOS
	$fields[] = array (
		'key' => 'field_settings_posts',
		'label' => __('Paginas de Videos','nicolaprida'),
		'name' => 'settings_posts',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array ( 

			array(
				'key' => 'field_videos_front_page',
				'label' => __('Portada de Videos','nicolaprida'),
				'name' => 'videos_front_page',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),

			array(
				'key' => 'field_videos_layout_header_template',
				'label' => __('Cabezal de Video Singular','nicolaprida'),
				'name' => 'videos_layout_header_template',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'wpbc_template',
				),
				'taxonomy' => array(
				),
				'allow_null' => 0,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			),

			array(
				'key' => 'field_featured_videos',
				'label' => __('Videos Destacados','nicolaprida'),
				'name' => 'featured_videos',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'video',
				),
				'taxonomy' => array(
				),
				'allow_null' => 1,
				'multiple' => 1,
				'return_format' => 'id',
				'ui' => 1,
			),
		)
	);

	$fields[] = array(
				'key' => 'field_landing_page',
				'label' => __('Página Landing','nicolaprida'),
				'name' => 'landing_page',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'post_type' => array(
					0 => 'page',
				),
				'taxonomy' => array(
				),
				'allow_null' => 1,
				'multiple' => 0,
				'return_format' => 'id',
				'ui' => 1,
			);

	$fields[] = array (
		'key' => 'field_settings_footer',
		'label' => __('Footer','nicolaprida'),
		'name' => 'settings_footer',
		'type' => 'group',
		'value' => NULL,
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'layout' => 'block',
		'sub_fields' => array ( 

			array (
				'key' => 'field_settings_footer_copyright',
				'label' => __('Copyright Text','nicolaprida'),
				'name' => 'copyright',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),

			array (
				'key' => 'field_settings_footer_logos',
				'label' => __('Logos/Sponsors','nicolaprida'),
				'name' => 'settings_footer_logos',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array ( 

					array (
						'key' => 'field_settings_sponsors_label',
						'label' => __('Label/Alt','nicolaprida'),
						'name' => 'label',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '40%',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_settings_sponsors_url',
						'label' => __('Url','nicolaprida'),
						'name' => 'url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '60%',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array (
						'key' => 'field_settings_sponsors_image',
						'label' =>  __('Image','nicolaprida'),
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '50%',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'id',
						'preview_size' => 'thumbnail',
					), 

				),
			),

		),
	);
  


	if( function_exists('acf_add_local_field_group') ):
  
		acf_add_local_field_group(array(
			'key' => 'group_'.$location_value,
			'title' =>  __('Theme Options','nicolaprida'),
			'fields' => $fields,
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => $location_value,
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));

		endif; 

}