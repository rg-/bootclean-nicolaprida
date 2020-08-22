<?php
/*

	Custom layout builder rows NOT USED

*/

add_filter('WPBC_acf_builder_layouts', 'WPBC_acf_builder_layouts__template_tabs_row',10,1);

function WPBC_acf_builder_layouts__template_tabs_row($layouts){

	$layouts['layout_template_tabs_row'] =  array(
		'key' => 'layout_template_tabs_row',
		'name' => 'template_tabs_row',
		'label' => 'Template Tabs Row',
		'display' => 'block',
		'sub_fields' => array(
			
			 array(
				'key' => 'key__layout_template_tabs_row__content',
				'label' => 'Content',
				'name' => 'content',
				'type' => 'clone',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'clone' => array(
						0 => 'key__r_tab__content',
						1 => 'key__r_wpbc_template_repeater',
						2 => 'key__r_tab__settings',
						3 => 'key__r_builder_classes_group',
						4 => 'key__r_tab__advanced',
						5 => 'key__r_wpbc__advanced_group_inview', 
					),
				'display' => 'seamless',
				'layout' => 'block',
				'prefix_label' => 0,
				'prefix_name' => 0,
			),
		),
		'min' => '',
		'max' => '',
	);  

	return $layouts;

} 

acf_add_local_field_group(array(
	'key' => 'group_reusables_menu_tabs_row',
	'title' => '#Reusables Menu Tabs',
	'fields' => field_layout_menu_tabs_row__content(),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 0,
	'description' => '# Reusable "anywhere" fields, all here.',
));

function field_layout_menu_tabs_row__content(){

	$fields[] = array(); 

	//  key__r_wpbc_template_repeater
	$fields[] = array (
		'key' => 'key__r_wpbc_template_repeater',
		'label' => 'Templates',
		'name' => 'templates',
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
		'button_label' => 'Add Template',
		'sub_fields' => array (

			array (
				'key' => 'key__r_wpbc_template_repeater_label',
				'label' => 'Label',
				'name' => 'label',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '20%',
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
				'key' => 'key__r_wpbc_template_repeater_template_id',
				'label' => 'Template',
				'name' => 'template_id',
				'type' => 'post_object',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '80%',
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

		),
	);

	return $fields;

}