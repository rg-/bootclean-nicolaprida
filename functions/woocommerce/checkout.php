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
		$show = false;
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
			</div>
		</div>
	</div>
</div><!-- #affix-checkout-area end -->

	<?php

});