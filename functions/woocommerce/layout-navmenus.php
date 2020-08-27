<?php

add_action('wpbc/layout/start', function(){

	$landing_page = WPBC_get_field('landing_page','options');

	if(!is_user_logged_in() && is_page($landing_page)){ 
		// remove_action('wpbc/layout/start','WPBC_layout_struture__main_navbar',10); 
	}

	echo do_shortcode('[WPBC_get_template name="parts/fixed-top-messages"]');

},0);

/*
	main-navbar args for woo pages here
*/
add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){  

	$logo = get_stylesheet_directory_uri().'/images/theme/logo-nico-laprida-white.png'; 

	$post_type = get_post_type();
	
	if( is_shop() || is_cart() || is_checkout() || $post_type == 'product' ){ 
		$args['navbar_brand']['title'] = '<img src="'.$logo.'" alt="'.get_bloginfo('title').'" class="navbar-brand-img " width="60" />';
	}

	if( is_shop() || is_account_page() ){ 
		$args['affix_defaults']['simulate'] = true;
	}

	$landing_page = WPBC_get_field('landing_page','options');
	if(!is_user_logged_in() && ( is_page($landing_page) ) ){ 
			 
		$args['affix'] = false;
		$args['affix_defaults']['simulate'] = false;
		$args['navbar_brand'] = false;
		$args['class'] .= ' affix-absolute-top py-2'; 
 		$args['wp_nav_menu']['theme_location'] = 'right_menu';

 		//$args['navbar_toggler'] = false;
		//$args['wp_nav_menu'] = false;

	}

	if(!is_user_logged_in() && is_checkout()){ 
		$args['affix'] = false;
		$args['affix_defaults']['simulate'] = false; 
		$args['class'] .= ' affix-absolute-top '; 
 		$args['wp_nav_menu']['theme_location'] = 'right_menu';
	}

	return $args;
},10,1);  

/*
	Add menu items.... 
*/
	
add_filter('wp_nav_menu_items', 'custom_wp_nav_menu_items', 10, 2);

function custom_wp_nav_menu_items($items, $args){ 
	
	$items_class = 'navbar-social';

	$user_registration_myaccount_page_id = get_option('woocommerce_myaccount_page_id');
	
	$url = get_permalink( $user_registration_myaccount_page_id );
	
	$items_icons = '';
	
	if( is_user_logged_in() ){  
		global $post;
		if($post->ID == $user_registration_myaccount_page_id){
			$active = 'active';
		}else{
			$active = '';
		}

		$items .= '<li class="menu-item nav-item nav-user nav-mi-cuenta"><a title="Mi Cuenta" href="'.$url .'" class="nav-link '.$active.'" >Mi Cuenta</a></li>';
		$items .= '<li class="menu-item nav-item nav-user nav-salir"><a title="Salir" href="'. esc_url( wc_logout_url() ) .'" class="nav-link" >Salir</a></li>';
	}else{ 
		$items .= '<li class="menu-item nav-item nav-user nav-ingresar"><a title="Ingresar" href="'.$url .'" class="nav-link" >Ingresar</a></li>';
	}
	
	return $items;

}