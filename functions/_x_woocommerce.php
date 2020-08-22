<?php

// https://www.wpexplorer.com/woocommerce-compatible-theme/ 


add_action( 'after_setup_theme', function() {
	if ( WPEX_WOOCOMMERCE_ACTIVE ) {
		add_theme_support( 'woocommerce' );
	}
} );



// Remove all Woo Styles
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/* or specific */
// add_filter( 'woocommerce_enqueue_styles', 'wpex_remove_woo_styles' );
function wpex_remove_woo_styles( $styles ) {
	unset( $styles['woocommerce-general'] );
	unset( $styles['woocommerce-layout'] );
	unset( $styles['woocommerce-smallscreen'] );
	return $styles;
}

/*
	Enable WooCommerce Product Gallery, Zoom & Lightbox (v3.0+)
*/

//add_theme_support( 'wc-product-gallery-slider' );
//add_theme_support( 'wc-product-gallery-zoom' );
//add_theme_support( 'wc-product-gallery-lightbox' ); 