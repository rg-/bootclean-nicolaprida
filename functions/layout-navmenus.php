<?php

function child_register_nav_menu(){
  register_nav_menus( array( 
      'right_menu'  => __( 'Menu Secundario'),
  ) ); 
}
add_action( 'after_setup_theme', 'child_register_nav_menu', 0 );

/*

	Filter main-navbar settings

*/


function nc_use_alt_nav(){
	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_front_page'];

	$settings_rutinas = get_field('settings_rutinas','options');
	$rutinas_front_page = $settings_rutinas['rutinas_front_page'];
 
	if( is_home() || is_page($videos_front_page)  || is_page($rutinas_front_page) ){
		return true;
	}else{
		return false;
	}
}
	
add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){  
	
	//$args['class'] = 'gpx-1 gpx-sm-0 navbar navbar-dark bg-primary navbar-expand-lg navbar-expand-aside collapse-right'; 

	$logo = get_stylesheet_directory_uri().'/images/theme/logo-nico-laprida-white.png'; 
	
	$args['class'] = 'navbar navbar-expand-md bg-transparent navbar-expand-aside collapse-right';
	
	$args['nav_attrs'] = ' data-affix-target="#main-content-wrap" data-affix-addclass="bg-primary" data-affix-removeclass="bg-transparent"';	

	$args['container_class'] = 'container gpx-1 aside-expand-content';
	  
	$args['navbar_brand']['class'] = 'navbar-brand gpt-1';
	$args['navbar_brand']['attrs'] = ' data-affix-removeclass="gpt-1" data-affix-addclass="" ';  

	if( nc_use_alt_nav() ){
		$args['navbar_brand']['title'] = '<img src="'.$logo.'" alt="'.get_bloginfo('title').'" class="navbar-brand-img gpr-2 gpr-sm-0" width="100" data-affix-addclass="d-none" /><img src="'.$logo.'" alt="'.get_bloginfo('title').'" class="navbar-brand-img d-none" width="60" data-affix-removeclass="d-none" data-affix-addclass="d-block" />';
	}else{
		$args['navbar_brand']['title'] = '<img src="'.$logo.'" alt="'.get_bloginfo('title').'" class="navbar-brand-img " width="60" />';
	} 

	$args['navbar_toggler']['class'] = 'toggler-white toggler-open-primary ml-auto ';
	$args['navbar_toggler']['type'] = 'animate';
	$args['navbar_toggler']['effect'] = 'close-arrow'; 
	//$args['navbar_toggler']['attrs'] = 'data-affix-addclass="toggler-white" data-affix-removeclass="toggler-white"'; 

	$args['wp_nav_menu']['container_class'] = 'collapse navbar-collapse flex-row-reverse';
	$args['wp_nav_menu']['menu_class'] = 'navbar-nav nav'; 

	$args['affix'] = true;
	if( is_404() ){
		$simulate = true;
	}else{
		$simulate = false;
	}

	if( class_exists( 'WooCommerce' ) ){
		$post_type = get_post_type();
		if( is_shop() || is_cart() || is_checkout()  || is_account_page() ){ 
			//$simulate = true;
		}
	}

	$args['affix_defaults']['simulate'] = $simulate;
	$args['affix_defaults']['breakpoint'] = 'xs';
	$args['affix_defaults']['scrollify'] = true; 
	
	return $args;
},10,1);   

/*

	Add nav_menu_link_attributes

*/

add_filter('nav_menu_link_attributes', 'child_nav_menu_link_attributes', 10, 4); 
function child_nav_menu_link_attributes($atts, $item, $args, $depth){ 
	$atts['data-scrollify-target'] = '#main-navbar';
	//$atts['class'] = $atts['class'].' scroll-to ';
	if ( isset( $args->has_children ) && $args->has_children && 0 === $depth && $args->depth > 1 ) {
		//$atts['data-target'] = '#dm'; 
		$atts['data-hover'] = 'dropdown';
		$atts['data-hover-respond'] = 'md'; // same as main-navbar collapse 

		$atts['class'] .= ' has-caret ';
		unset($atts['aria-haspopup']);
		unset($atts['aria-expanded']);
		unset($atts['data-toggle']);
		unset($atts['data-target']);
		unset($atts['id']);
	}  

	$atts['title'] = '';
	return $atts;
}


add_filter('walker_nav_menu_start_el','child_walker_nav_menu_start_el',10,4); 
function child_walker_nav_menu_start_el($item_output, $item, $depth, $args) {
	// $item->classes
	// $item->url .....
	// $args->has_children
	if ( isset( $args->has_children ) && $args->has_children && 0 === $depth && $args->depth > 1 ) {
		$url = ! empty( $item->url ) ? $item->url : '#';
		$item_output .= '<a href="'.$url.'" id="'.'menu-item-link-dropdown-' . $item->ID.'" data-toggle="dropdown" class="caret dropdown-toggle" data-target="'.'#menu-item-dropdown-' . $item->ID.'" ><i class="fa fa-angle-down"></i></a>';
	}
	return $item_output;
}