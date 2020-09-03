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
		$subscription_pending = wcs_user_has_subscription( $current_user_id, '', 'pending' ); 
		$subscription_on_hold = wcs_user_has_subscription( $current_user_id, '', 'on-hold' ); 
		$subscription_cancelled = wcs_user_has_subscription( $current_user_id, '', 'cancelled' );
		$subscription_switched = wcs_user_has_subscription( $current_user_id, '', 'switched' );
		$subscription_expired = wcs_user_has_subscription( $current_user_id, '', 'expired' );


		if($status == 'subscriber' || $status == 'customer'){
			
			if($subscription_active) {
				$status .= '_active';
			} 
			if($subscription_pending) {
				$status .= '_pending';
			} 
			if($subscription_on_hold){
				$status .= '_on_hold';
			}
			if($subscription_cancelled){
				$status .= '_cancelled';
			}
			if($subscription_expired){
				$status .= '_expired';
			}

		}

	} 
	return $status; 
}  

add_action('wpbc/layout/start',function(){
	// echo do_shortcode('[WPBC_get_template name="parts/fixed-top-messages"]');

	$landing_page_id = WPBC_get_field('landing_page','options'); 
	$landing_page = get_permalink( $landing_page_id );  

	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_front_page'];
	$videos_page = get_permalink( $videos_front_page );

	$myaccount_page_id = get_option('woocommerce_myaccount_page_id');
	$subscriptions_page = wc_get_endpoint_url('subscriptions', '', get_permalink($myaccount_page_id));

	$user_status = WPBC_detect_user_status();
	if( $user_status!='administrator' && !is_checkout() && is_user_logged_in() && (is_account_page() || is_page($landing_page_id)) ){
		$message = ''; 
		$bg_status = 'bg-danger';
 		switch ($user_status) {

 			case 'subscriber_active':
 				$message = '¡Tu subscripción está activa! <br> ';
 				$message .= 'Tienes acceso a todo el contenido privado, ver todos los <a class="link" href="'.$videos_page.'">Videos</a>';
		    $bg_status = 'bg-success';
		    break; 

		  case 'subscriber_active_expired':
 				$message = '¡Tu subscripción está activa! <br> ';
 				$message .= 'Tienes acceso a todo el contenido privado, ver todos los <a class="link" href="'.$videos_page.'">Videos</a>';
		    $bg_status = 'bg-success';
		    break; 
 			
 			case 'customer':
		    $message = 'Tu subscripción está inactiva.';
		    if(!is_page($landing_page_id)){
					$message .= ' Ir a <a class="link" href="'.$landing_page.'">Comprar</a>';
				}
		    break; 

		  case 'customer_expired':
		    $message = 'Tu subscripción ha expirado.';
		    if(!is_page($landing_page_id)){
					$message .= ' Ir a <a class="link" href="'.$landing_page.'">Comprar</a> o renueva tu <a class="link" href="'.$subscriptions_page.'">Subscripción</a>.';
				}
		    break; 

		  case 'customer_pending_expired':
		    $message = 'Tienes una <a class="link" href="'.$subscriptions_page.'">Subscripción</a> pendiente de pago. <br>';
				$message .= '<small>En unos momentos estará activa dependiendo del método de pago usado.</small>';
		    break;

		  case 'customer_on_hold_expired':
		    $message = 'Tienes una <a class="link" href="'.$subscriptions_page.'">Subscripción</a> pendiente de pago. <br>';
				$message .= '<small>En unos momentos estará activa dependiendo del método de pago usado.</small>';
		    break;  

		  case 'customer_on_hold':
		    $message = 'Tienes una <a class="link" href="'.$subscriptions_page.'">Subscripción</a> pendiente de pago. <br>';
				$message .= '<small>En unos momentos estará activa dependiendo del método de pago usado.</small>';
		    break;

		  case 'customer_pending':
		    $message = 'Tienes una <a class="link" href="'.$subscriptions_page.'">Subscripción</a> pendiente de pago. <br>';
				$message .= '<small>En unos momentos estará activa dependiendo del método de pago usado.</small>';
		    break;
		  
		  default:
		    $message = $user_status;
		}

		if(!empty($message)){
		?>
<div class="fixed-top-messages">
	<div class="container">
		<div class="d-flex justify-content-center gpy-1">
			<p class="d-none user_status"><?php echo $user_status; ?></p>
			<p class="m-0 text-center"><?php echo $message; ?></p>
		</div>
	</div>
	<i class="<?php echo $bg_status; ?> bg-message"></i>
</div>
		<?php
		}
	} 
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