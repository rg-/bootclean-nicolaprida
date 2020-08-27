<?php

/* Disable ACF Form on front-end */
add_filter('wpbc/filter/acf/enable_acf_form',function(){
	return false;
});
/*

	Add custom field into Page Settings > Main Navbar 
	
	Filter default tabs positions:

		10 Main Navbar
		20 Page Header
		20 Main Footer
		40 Custom Layout
		50 Custom Styles

	Notice the position "11" in this case. 

*/

add_filter('WPBC_group_builder__layout', 'custom_Page_Settings_MenuLoL', 41, 1); 

function custom_Page_Settings_MenuLoL($fields){
	
	
	
	return $fields;
}  