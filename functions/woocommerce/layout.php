<?php

add_filter('wpbc/filter/woocommerce/config', 'child_woocommerce_config',10,1);

function child_woocommerce_config($wpbc_woocommerce_config){

	/*
		Change widgets (NEVER EVER CHANGE IDS ON PRODUCTION SITE!!!!!)

		by default config has 2 woo widgets areas:

			widget_area_woocommerce
			widget_area_woocommerce_products

		You could unset one, both, add new ones, or modify args on default ones.

	*/

	//$wpbc_woocommerce_config['widgets']['widget_area_woocommerce']['name'] = 'Custom widget name here';
	//$wpbc_woocommerce_config['widgets']['widget_area_woocommerce']['description'] = 'Custom description here';


	$wpbc_woocommerce_config['layout']['shop'] = array(

		'main_container_areas_class' => 'container',
		'main_container_row_class' => 'row',
		'content_areas_cols' => array(
			'main_class' => 'col-12',
			'col_class' => 'col-12',
			//'col_content' => do_shortcode('[WPBC_get_template name="layout/secondary-content" args="name:area-1"/]'),
		),
		'content_areas_single' => array(
			'main_class' => 'col-12', 
		),

	);  

	// $wpbc_woocommerce_config['layout']['before_woo-main-container-area'] = do_shortcode('[WPBC_get_template name="woocommerce/grouped-product_elegir-recetas" /]');

	return $wpbc_woocommerce_config;
} 

add_filter('wpbc/body/class', function ($class){
	$post_type = get_post_type();
	if( is_shop() || is_checkout() || $post_type == 'product' ){ 
		$class .= ' single-header ';
	} 
	return $class;
}, 10,1 );  

add_filter('wpbc/filter/layout/locations', function($locations){
	if( is_account_page() ){
		$locations['page']['id'] = 'a1'; 
		$locations['page']['args']['container_type'] = 'fixed'; 
	}
	if( is_cart() || is_checkout() ){
		$locations['page']['id'] = 'a1';  
	} 
	return $locations;  
}, 20, 1 ); 

add_filter('wpbc/filter/layout/location', function($layout, $template, $using_theme_settings, $using_page_settings){
	if($template == 'page'){
		//$layout = 'a2-ml';
		if( is_account_page() || is_cart() || is_checkout() ){
			$layout = 'a1';
		}
	}
	return $layout;
},10,4);


add_filter('wpbc/filter/layout/start/defaults', function($args){  
	if( is_cart() || is_checkout() ){
		$args['main_content']['wrap']['class'] = '';
	}
	return $args;
});  

add_filter('wpbc/filter/page/single/class',function($class){
	if( is_woocommerce() || is_account_page() || is_cart() ){
		$class .= 'woo-single-page';
	}
	return $class;
},10,1); 


/*

	Usar el mismo Area Secondary que tienda en las demas woo pages

*/
add_filter('wpbc/filter/layout/secondary-content/post_id',function($post_id){
	if( is_shop() || is_cart() || is_checkout() || is_singular('product') ){ 
		$post_id = get_option( 'woocommerce_shop_page_id' ); 
	}
	return $post_id;
},10,1);

add_filter('wpbc/filter/layout/main-page-header/defaults',function($defaults){ 
	if( is_shop() || is_cart() || is_checkout() || is_singular('product') ){
		$template_id = get_videos_layout_header_template();  
		$defaults['template_id'] = $template_id;
	}
	return $defaults;  
},20,1);




/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

add_filter( 'woocommerce_loop_add_to_cart_link', function($link, $product, $args){ 
	return $link;
},10, 3);

/*
	##############################
	templates/archive-product.php
	##############################
*/ 
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */ 
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
remove_action( 'woocommerce_before_shop_loop','woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30 );



/*

	Templates content-single-product.php

*/

	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );


	/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_images', 6 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);