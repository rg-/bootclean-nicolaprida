<?php 

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

		$current_user_id = get_current_user_id();

		$items .= '<li class="menu-item nav-item nav-user nav-mi-cuenta"><a title="Mis Turnos" href="https://reservas.nicolaprida.com/mis-turnos/?u='.$current_user_id.'" class="nav-link" >Mis Turnos</a></li>';

		$items .= '<li class="menu-item nav-item nav-user nav-mi-cuenta"><a title="Mi Cuenta" href="'.$url .'" class="nav-link '.$active.'" >Mi Cuenta</a></li>';
		$items .= '<li class="menu-item nav-item nav-user nav-salir"><a title="Salir" href="'. esc_url( wc_logout_url() ) .'" class="nav-link" >Salir</a></li>';
	}else{ 
		$items .= '<li class="menu-item nav-item nav-user nav-ingresar"><a title="Ingresar" href="'.$url .'" class="nav-link" >Ingresar</a></li>';
	}
	
	return $items;

}