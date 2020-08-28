<?php
/*

	Make Bootclean template compatible

*/
add_action('init', function(){

	add_action('wpbc/layout/body/start', function(){
		$post_type = get_post_type();
		if( is_shop() || $post_type == 'product' ){ 
			action__wpbc_layout_start__container_block_start(); 
			WPBC_layout_struture__build('main_navbar');
			WPBC_layout_struture__build('main_pageheader');
			WPBC_layout_struture__main_content_wrap();
			?>
			<div id="main-container-areas" class="a2-ml gpy-2 gpy-md-3 container">
				<div id="main-container-row" class="a2-ml row">
					<?php if(!is_singular('productX')){ ?>
					<div id="main-content-area" class="a2-ml col-lg-8 gpr-lg-4 ">
					<?php }?>
			<?php
		}
	},50);

	add_action('wpbc/layout/body/end', function(){
		$post_type = get_post_type();
		if( is_shop() || $post_type == 'product' ){  
			?>
					<?php if(!is_singular('productX')){ ?>
					</div>
					<div id="area-1" class="a2-ml col-lg-4">
						<?php
						echo do_shortcode('[WPBC_get_template name="layout/secondary-content" args="name:area-1"/]');
						?>
					</div>
					<?php }?>
				</div>
			</div>
			<?php
			WPBC_layout_struture__build('main_footer');
			WPBC_layout_struture__main_content_wrap_end();
			action__wpbc_layout_end__container_block_end(); 
		}
	},10); 

	add_filter('wpbc/filter/layout/locations', function($locations){
		if(is_account_page()){
			$locations['page']['id'] = 'a2-ml'; 
			$locations['page']['args']['container_type'] = 'fixed'; 
		}
		if( is_cart() || is_checkout() ){
			$locations['page']['id'] = 'a1'; 
			//$locations['_template_builder']['args']['container_type'] = 'fixed'; 
		}
		return $locations;  
	}, 10,1 );

});


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
	if( is_shop() || is_cart() || is_checkout() || is_singular('product') || is_account_page() ){
		$template_id = get_videos_layout_header_template();  
		$defaults['template_id'] = $template_id;
	}
	return $defaults;  
},20,1);

add_filter('wpbc/body/class', 'woocommerce_body_class',10,1 ); 
function woocommerce_body_class($class){
	$post_type = get_post_type();
	if( is_shop() || is_cart() || is_checkout() || $post_type == 'product' || is_account_page() ){ 
		// $class .= ' single-header ';
	}
	return $class;
}

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