<?php

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