<?php

/*

	wpbc woocommerce config for Checkout pages

*/
add_filter('wpbc/filter/woocommerce/config', function ($wpbc_woocommerce_config){
	
	$wpbc_woocommerce_config['layout']['checkout'] = array(
		'class' => ' col-col2-flex-column ', // make columns as rows
	);

	return $wpbc_woocommerce_config;

},10,1); 


add_filter('wpbc/body/class', function($class){
	if( is_checkout()  ){
		$class .= ' single-header ';
	}
	return $class;

},10,1 ); 

add_filter('wpbc/filter/layout/main-page-header/defaults',function($defaults){ 
	if( is_checkout()  ){
		$template_id = get_videos_layout_header_template();  
		$defaults['template_id'] = $template_id; 
	}
	return $defaults;  
},10,1);

add_filter('WPBC_post_header_title_class', function($class){
	if( is_wc_endpoint_url( 'order-received' ) && isset($_GET['key']) ){
		$class = 'section-title text-center font-gilroysb';
	}
	return $class; 
},10,1);

add_filter( 'WPBC_post_header_title', function($_post_title, $title_tag, $title_class){
	if( is_wc_endpoint_url( 'order-received' ) && isset($_GET['key']) ){  
		$_post_title = '¡Gracias, tu solicitud ha sido recibida!';
	}
	return $_post_title; 
},10, 3); 

add_filter( 'laprida/single/page/entry-content/class', function($class){
	if( is_wc_endpoint_url( 'order-received' ) && isset($_GET['key']) ){  
		$class = 'gmb-1 entry-content';
	}
	return $class; 
},10, 3); 


add_filter( 'woocommerce_thankyou_order_received_text', function($text, $order){
	if( is_wc_endpoint_url( 'order-received' ) && isset($_GET['key']) ){
		$text = 'Tu pago está siendo procesado y está pendiente de activación <br><small>Revisa tu correo recibirás un email con las instrucciones de acceso.</small>';
	}
	return $text;
},10,2 ); 


add_filter('wpbc/filter/page/single/class',function($class){
	if( is_checkout() ){
		$class = ' woo-is_checkout ui-loader';
	} 
	return $class;
},10,1); 

add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){  
	if( is_checkout() ){
		$args['affix'] = false;
		$args['class'] .= ' affix-absolute-top ';
	}
	return $args;
	},10,1);

add_action('wpbc/layout/start', function(){   
	
	if( is_checkout() ){
		remove_action('wpbc/layout/start', 'theme_custom_search_form',39);
	} 

},0);

add_filter('laprida/single/page/footer',function($use){
	if( is_checkout() ){
		$use = false;
	}
	return $use; 
},10,1);  
add_filter('laprida/single/page/actions',function($use){
	if( is_checkout() ){
		$use = false;
	}
	return $use; 
},10,1);  

add_filter('WPBC_post_header_show', function($show){
	if( is_checkout() ){
		//$show = false;
	}
	return $show; 
},10,1); 



/*
	
	woo actions/filters

*/

	/*
	Change the woocommerce login toggle on checkout (if enabled)
	*/
	add_filter( 'woocommerce_checkout_login_message', function($msg){ 
		$msg = '¿Ya tenés una cuenta?';
		return $msg; 
	},10,2 );

	/*
	
	Change layout for login form and cart resume

	templates/checkout/form-checkout.php

	*/
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
	
	// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 ); 
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

	add_action('woocommerce_before_checkout_form',function($checkout){
		?>
		<div id="affix-checkout-area" class="position-relative">
		<div class="col2-set">
			<div class="col-1">
				<div class="woo-custom-checkout-login-form">
					
					<?php woocommerce_checkout_login_form(); ?>
				</div>
			</div>
		</div>
		<?php 
	},10,1);

	add_action('woocommerce_after_checkout_form',function($checkout){
		?>
		</div>
		<?php 
	},10,1);

	add_action('woocommerce_checkout_before_customer_details', function(){  

	?>
	<div>
	<?php 
});

add_action( 'woocommerce_after_checkout_validation', 'wpbc_checkout_validation_one_err', 9999, 2);
 
function wpbc_checkout_validation_one_err( $fields, $errors ){ 
	// if any validation errors
	if( !empty( $errors->get_error_codes() ) ) { 
		// remove all of them
		foreach( $errors->get_error_codes() as $code ) {
			$errors->remove( $code );
		} 
		// add our custom one
		$errors->add( 'validation', 'Revisa los campos marcados en rojo para continuar.' ); 
	} 
}

add_action('woocommerce_checkout_after_customer_details', function(){  

	?> 

	<div class="col2-set">
		<div class="col-1">

			<h3 class="woo-form-title gmb-1">Método de pago</h3>
			<p class="font-size-14">Seleccione el método de pago preferido.</p>

			<?php woocommerce_checkout_payment(); ?>

		</div>
	</div> 

<div id="affix-column" class="affix-container-absolute z-index-40" data-toggle="nav-affix" data-affix-position="top" data-affix-breakpoint="lg" data-affix-target="#affix-checkout-area" data-affix-simulate="false" data-affix-scrollify="true" data-affix-detect="bottom" data-affix-inner-element=".affix-column">
	<div class="container affix-container"> 
		<!-- woo-custom-checkout-review-order column  -->
		<div class="col-lg-4 order-md-2 ml-auto affix-column">
			<div class="woo-custom-checkout-review-order">
				<h3 class="woo-form-title gmt-1 gmb-1">Resumen del pedido</h3>
				<?php
			 	woocommerce_order_review();
				?>
				<?php
				$landing_page_id = WPBC_get_field('landing_page','options');
				?>
				<a class="" data-woo="empty-cart" data-loading-target=".woo-is_checkout" href="<?php echo get_the_permalink($landing_page_id); ?>"><i class="fa fa-angle-left"></i> Cambiar Plan</a>
			</div>
		</div>
	</div>
</div><!-- #affix-checkout-area end -->

	<?php

	WPBC_get_template_part('parts/empty_cart_redirecting');

});