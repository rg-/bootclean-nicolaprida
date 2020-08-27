<?php

	$msg = "";
	
	$landing_page_id = WPBC_get_field('landing_page','options');

	$user_registration_myaccount_page_id = get_option('woocommerce_myaccount_page_id'); 

	$myaccount_page = get_permalink( $user_registration_myaccount_page_id );  
	

	if(!is_user_logged_in()){
		
	}

	global $woocommerce;

	if( $woocommerce->cart->cart_contents_count != 0 && !is_checkout() ){
		$msg = 'Tienes un pedido de compra pendiente';
	}


	if( $msg != '' ){ 

		

		?>

<div class="fixed-top-messages bg-warning">

	<div class="container">

		<div class="d-flex justify-content-center">

			<?php echo $msg; ?>

		</div>

	</div>

</div>

		<?php

	}

?>