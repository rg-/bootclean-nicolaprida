<?php
/*

	TEMPLATE LANDING

	In this case i´m using just default "page header" section
	Rest is a flexible content group

	See how i add this part into 'wpbc/layout/start'
	so sections from this flexible whil be placed inside "main-content-wrap" just before footer

*/

add_filter('wpbc/filter/template-landing/exclude_page_settings', '__return_true',10,1 );

/*

	Disable section helper (key field) on admin

*/

add_filter('wpbc/filter/template-landing/fields/show_helper','__return_false',10,1);

/* 

	ADDING builder_flexible (same as for pages) into landing template 
	This filter is in fact the array used by ACF to set the location for a field group

*/ 

add_filter('wpbc/filter/acf/builder/flexible_content_locations',function($locations){
	$locations[] = array(
		array(
			'param' => 'page_template',
			'operator' => '==',
			'value' => '_template_landing_builder.php',
		)
	);
	return $locations;
},10,1);

/* 
	Then make available the builder flexible (flexible_content_locations) on front-end
*/
add_action('wpbc/layout/start', function(){
	if( is_page_template('_template_landing_builder.php') ){
		global $post;
		WPBC_get_template_builder($post->ID);
	}
},31);

/* 

Change order for admin groups if needed, notice you can´t use 0, since it´s reserved for a hidden group to store all the reusables (this should be discarted on future versions, no need for such complexity)

*/

add_filter('wpbc/filter/template-landing/group/menu_order', function($order){
	return $order; // def 5
},10,1);
add_filter('wpbc/filter/builder/group/menu_order', function($order){
	$order = 10;
	return $order; // def 3
},10,1);
add_filter('wpbc/filter/page-settings/group/menu_order', function($order){
	return $order; // def 1
},10,1);




/*

	LAYOUT FRONT END 
 
*/ 


/* Wrap sections into DIV */
add_action('wpbc/layout/sections/start', function($sections, $is_page_header){
	if(!$is_page_header) {
		echo "<div id='sections-wrapper'>";
	}
},0,2);
add_action('wpbc/layout/sections/end', function($sections, $is_page_header){
	if(!$is_page_header) echo "</div>";
},0,2);