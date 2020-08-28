<?php

function WPBC_detect_user_status(){ 
	$status = 'visitor'; 
	if( is_user_logged_in() ){
		$status = 'customer'; 
		$current_user_id = get_current_user_id();
		$user = get_userdata( $current_user_id );
		$allowed_roles = array(
			'administrator',
			'editor',
			'shop_manager', 
		);
		$status = array_intersect( $allowed_roles, (array) $user->roles ) ? 'administrator' : $status;

		$allowed_subscriber = array(
			'subscriber', 
		);
		$status = array_intersect( $allowed_subscriber, (array) $user->roles ) ? 'subscriber' : $status; 

		$subscription_active = wcs_user_has_subscription( $current_user_id, '', 'active' ); 
		$subscription_on_hold = wcs_user_has_subscription( $current_user_id, '', 'on-hold' ); 
		$subscription_cancelled = wcs_user_has_subscription( $current_user_id, '', 'cancelled' );
		$subscription_switched = wcs_user_has_subscription( $current_user_id, '', 'switched' );
		$subscription_expired = wcs_user_has_subscription( $current_user_id, '', 'expired' );
		if($status == 'subscriber' || $status == 'customer'){
			if($subscription_active) {
				$status .= '_active';
			}else{
				if($subscription_on_hold){
					$status .= '_on_hold';
				}
				if($subscription_expired){
					$status .= '_on_hold';
				}
			} 
		}

	} 
	return $status; 
}


add_filter('wpbc/filter/layout/main_pageheader/end', function($out){ 
	//$out .= do_shortcode('[WPBC_get_template name="parts/fixed-top-messages"]'); 
	return $out;
},10,1);  

add_action('wpbc/layout/start',function(){
	echo do_shortcode('[WPBC_get_template name="parts/fixed-top-messages"]');
},31);


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
		//$args['affix_defaults']['simulate'] = true;
	}

	$landing_page = WPBC_get_field('landing_page','options');

	$user_status = WPBC_detect_user_status();
	
	if( $user_status!='administrator' && !is_user_logged_in() && ( is_page($landing_page) ) ){ 
			 
		$args['affix'] = false;
		$args['affix_defaults']['simulate'] = false;
		$args['navbar_brand'] = false;
		$args['class'] .= ' affix-absolute-top py-2'; 
 		$args['wp_nav_menu']['theme_location'] = 'right_menu';

 		//$args['navbar_toggler'] = false;
		//$args['wp_nav_menu'] = false;

	}

	if( $user_status!='administrator' && !is_user_logged_in() && is_checkout() ){ 
		$args['affix'] = false;
		$args['affix_defaults']['simulate'] = false; 
		$args['class'] .= ' affix-absolute-top '; 
 		$args['wp_nav_menu']['theme_location'] = 'right_menu';
	}

	if( $user_status!='administrator' && is_user_logged_in() ){ 
		$user_id = get_current_user_id();
		$subscription_active = wcs_user_has_subscription( $user_id, '', 'active' ); 
		if(!$subscription_active){
			$args['wp_nav_menu']['theme_location'] = 'right_menu';
		}
	}

	return $args;
},10,1);   


add_filter('wpbc/builder/template_part_row', function($do_shortcode, $post_id, $template_id, $passed_args){
	$visible_conditional = get_sub_field('key__layout_template_part_row__content_'.'field_reusable_visible_conditional', $post_id);

	$user_status = WPBC_detect_user_status(); 

	if( $user_status!='administrator' && $visible_conditional ){
		if( is_user_logged_in() ){
			$do_shortcode = '';
		}
		// $do_shortcode = '';
	}
	return $do_shortcode;
},10,4);