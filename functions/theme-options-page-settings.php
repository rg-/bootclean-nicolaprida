<?php
/*
	
	WPBC_group_builder__layout

	Remove tabs and fields from Page Settings Group

*/

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout_custom',9999,1);  

function WPBC_group_builder__layout_custom($fields){
	
	$remove = array(

		// Removing Main Navbar tab and groups
		 //'field_layout_main_navbar_template__tab',
		 //'field_layout_main_navbar_template', 

		// Removing Main Footer tab and groups
		//'field_layout_footer__tab',
			//'field_layout_footer_template',

		// Removing Custom Layout tab and groups
		'field_custom_layout__tab',
			'field_custom_layout__enable',
			'field_custom_layout__custom_location',
			'field_custom_layout__container_type', 
	);

	/* Removing tabs for specif page template */
	if (isset($_GET['post'])) {
    $id = $_GET['post'];
    $template = get_post_meta($id, '_wp_page_template', true); 
    if($template == '_template_landing_builder.php'){
    	$remove_landing_builder = array(
    		// Removing Main Page Header tab and groups
				'field_layout_header__tab',
					'field_layout_header_template_type',
					'field_layout_header_template',
					'field_layout_header_template_class',
					'field_layout_header_template_html',
    	);
    	$remove = array_merge($remove_landing_builder, $remove);
    }
  }
	
	// Removing then based on $remove array
	foreach ($fields as $k => $field) {
		$key = $field['key']; 
		// check
		if (in_array($key, $remove)) {
			unset($fields[$k]);
		}
	} // end foreach
	
	return $fields; 

}


/*

	Remove flexible rows not used

*/
add_filter('wpbc/filter/acf/builder/flexible_content/layouts', function($layouts){ 
	//unset($layouts['layout_template_part_row']); 
	//unset($layouts['layout_widgets_row']); 
	unset($layouts['layout_navbar_row']); 
	//unset($layouts['layout_flexible_row']); 
	// $layouts = array(); 
	return $layouts; 
},10,1);  



/*

	Add a custom Tab group into Page Settings group

*/ 

add_filter('WPBC_group_builder__layout', 'WPBC_group_builder__layout__general', 9, 1);  

function WPBC_group_builder__layout__general($fields){
	  
	$fields[] = array (
		'key' => 'field_layout_general__tab',
		'label' => '<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/></svg> General',
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'top',
		'endpoint' => 0,
	);

	$fields[] = WPBC_acf_make_image_field(array(
		'name' => 'layout_general_body_background',
		'label'=>  'Fondo de página', 
	));

	return $fields;
} 


/*

	Use the custom settings if....

*/

add_filter('wpbc/body/class',function($class){

	if( WPBC_get_field('layout_general_body_background') ){
		$layout_general_body_background = WPBC_get_field('layout_general_body_background');
		$class .= ' image-cover attachment-fixed ';
	}

	return $class;

},10,1); 

add_filter('wpbc/body/data',function($data){

	if( WPBC_get_field('layout_general_body_background') ){
		$layout_general_body_background = WPBC_get_field('layout_general_body_background');
		$data .= ' style="background-image:url('.$layout_general_body_background['url'].');" ';
	}

	return $data;

},10,1); 