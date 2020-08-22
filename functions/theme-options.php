<?php

/* Add capability to user/s */ 

function fate_add_theme_caps(){
	$role_object = get_role( 'editor' );
	$role_object->add_cap( 'edit_theme_options' );
}
// add_action( 'admin_init', 'fate_add_theme_caps' );

/*
	Hide WPBC_layout_debug front-end
	(only loged users with admin capabilities)

*/
add_filter('WPBC_layout_debug',function(){
	return false; // true default
}, 10, 1);


/*

	Disable Dynamic Template Arguments on template_part_args flexible row layou

*/

	add_filter('wpbc/acf/reusables/template_part_args/use_builder_layout_row_data', function($use_builder_layout_row_data){
		return false;
	},10,1);

/*

	Show hide WPBC Theme Options back end

*/

add_filter('WPBC_options_show_menu',function(){
	return true; // false default
}, 10, 1);

/*

	Use a new database record into options for this theme if needed.
	
	Parent default one is "bootclean-options-theme"
	
	Functions to get options/defaults will keep working as well.
	
*/

/* 
add_filter('BC_theme_options_option_name', function(){
	return 'bootclean-child-options-theme'; 
});
*/


/* 
	Do not use Cleaner Login custom branding feature 

add_filter('BC_cleaner__login', function(){
	return false; 
});*/