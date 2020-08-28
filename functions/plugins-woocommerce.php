<?php

/*

	Even WPBC detects Woocomerce and define a constant:

	 "WPBC_WOOCOMMERCE_ACTIVE" 

	 Note: on templates can use the function WPBC_is_woocommerce_active() true/false

	Customizations must be enabled like so:

*/
add_filter('wpbc/filter/woocommerce/enable_customise','__return_true',10,1); 

/*
	
	Enable addons by filter

*/
add_filter('wpbc/filter/woocommerce/addons/myaccount-user-profile-picture','__return_true',10,1); 

/*
add_filter( 'woocommerce_add_to_cart_redirect', 'WPBC_woo_skip_cart_redirect_checkout' ); 
function WPBC_woo_skip_cart_redirect_checkout( $url ) {
    return wc_get_checkout_url();
}
*/

add_filter( 'woocommerce_login_redirect', 'WPBC_woo_woocommerce_login_redirect' );
function WPBC_woo_woocommerce_login_redirect( $url ) {
	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_front_page'];
	if($videos_front_page){
		$url = get_the_permalink($videos_front_page);
	}
  return $url;
}

/**
 * @snippet       WooCommerce Max 1 Product @ Cart
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WC 3.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
  
add_filter( 'woocommerce_add_to_cart_validation', 'WPBC_woo_only_one_in_cart', 99, 2 );
   
function WPBC_woo_only_one_in_cart( $passed, $added_product_id ) {
   wc_empty_cart();
   return $passed;
}

/**
 * Change currency display in WooCommerce
 * Put this in your functions.php file
 *
 */
add_filter('woocommerce_currency_symbol', 'WPBC_woo_currency_symbol', 10, 2);

function WPBC_woo_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
          case 'USD': $currency_symbol = ' USD'; break;
     }
     return $currency_symbol;
}

include('woocommerce/enqueue.php');

include('woocommerce/acf-woo-subscription.php');
include('woocommerce/layout.php');
include('woocommerce/layout-navmenus.php');
include('woocommerce/my-account.php');
include('woocommerce/cart.php');
include('woocommerce/checkout.php'); 

include('woocommerce/user-conditionals.php');