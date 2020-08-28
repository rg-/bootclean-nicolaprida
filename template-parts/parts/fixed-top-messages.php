<?php
	$user_status = WPBC_detect_user_status();
	if($user_status=='administrator'){
		// return;
	}

	$msg = '';

	$landing_page_id = WPBC_get_field('landing_page','options'); 
	$landing_page = get_permalink( $landing_page_id );  

	$current_user = wp_get_current_user();
	$user_id = get_current_user_id();
	$display_name = esc_html( $current_user->display_name );

	$subscription_active = wcs_user_has_subscription( $user_id, '', 'active' ); 
	$subscription_on_hold = wcs_user_has_subscription( $user_id, '', 'on-hold' ); 
	$subscription_cancelled = wcs_user_has_subscription( $user_id, '', 'cancelled' );
	$subscription_switched = wcs_user_has_subscription( $user_id, '', 'switched' );
	$subscription_expired = wcs_user_has_subscription( $user_id, '', 'expired' );
	
	$user = get_userdata( $user_id ); 

	if($user_status != 'administrator'){ 

		if(!$subscription_active && !$subscription_on_hold){
			$msg .= 'Tu subscripción está inactiva.';
			if(!is_page($landing_page_id)){
				$msg .= ' Ir al <a class="link" href="'.$landing_page.'">Comprar</a>';
			}
		} elseif ($subscription_canceled){ // NO NEED
			// $msg .= 'Tu subscripción está cancelada.';
		} elseif ($subscription_on_hold){
			$msg .= 'Tu subscripción está pendiente de activación.';
			if(!is_page($landing_page_id)){
				$msg .= ' Tienes acceso a <a class="link" href="'.$landing_page.'">Free Tour</a>';
			}
		} elseif($subscription_expired){
			$msg .= 'Tu subscripción está expirada.';
		}else{

		}

	}
	
	
	$woocommerce_myaccount_page_id = get_option('woocommerce_myaccount_page_id');  
	$myaccount_page = get_permalink( $woocommerce_myaccount_page_id );  
	$woocommerce_checkout_page_id = get_option('woocommerce_checkout_page_id');  
	$checkout_page = get_permalink( $woocommerce_checkout_page_id );  

	global $woocommerce;

	if( $woocommerce->cart->cart_contents_count != 0 && !is_checkout() ){
		$msg .= ' Tienes un pedido de compra pendiente. Ir al <a class="link" href="'.$checkout_page.'">Checkout</a>';
	} 

	if( $msg != '' && !is_checkout() && is_user_logged_in() ){ 

		?>

<div class="fixed-top-messages">

	<div class="container">

		<div class="d-flex justify-content-center gpy-1">

			<p class="d-none user_status"><?php echo $user_status; ?></p>

			<p class="m-0"><?php echo $msg; ?></p>

		</div>

	</div>

	<i class="bg-danger bg-message"></i>

</div>

		<?php

	}

?>