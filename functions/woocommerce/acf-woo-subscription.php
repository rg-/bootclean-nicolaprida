<?php

add_action('init',function(){

	$fields = array(); 

		$fields[] = WPBC_acf_make_text_field(array(
			'label' => 'Descripción',
			'name' => 'woo_single_product_desc',
			'width' => '50%',
		));  
		$fields[] = WPBC_acf_make_text_field(array(
			'label' => 'Descripción para el descuento',
			'name' => 'woo_single_product_discount_desc',
			'width' => '50%',
		));    

	if( function_exists('acf_add_local_field_group') ){ 

		acf_add_local_field_group(array(
			'key' => 'group_woo_single_product',
			'title' => 'Detalles Membresía',
			'fields' => $fields,
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'product',
					),
					array(
						'param' => 'post_taxonomy',
						'operator' => '==',
						'value' => 'product_type:subscription',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));

	}

});

add_action('add_meta_boxes','WPBC_woo_grouped_meta_boxes', 50);

function WPBC_woo_grouped_meta_boxes(){
	$get_screen = get_current_screen();
  $current_screen = $get_screen->post_type; 
  if ($current_screen == 'product' && isset($_GET['post']) ) {  
		$product = wc_get_product( $_GET['post'] );
		if($product->get_type() == 'subscription'){ 
			remove_meta_box( 'postexcerpt' , 'product' , 'normal' );
			remove_meta_box( 'commentsdiv' , 'product' , 'normal' );
			remove_meta_box( 'woocommerce-product-images' , 'product' , 'side' );
			remove_meta_box( 'postimagediv' , 'product' , 'side' );
			remove_meta_box( 'product_catdiv' , 'product' , 'side' );
			remove_meta_box( 'tagsdiv-product_tag' , 'product' , 'side' );
		}
  }  
}

add_action('add_meta_boxes','WPBC_woo_grouped_meta_boxes', 50);

add_action( 'current_screen', 'WPBC_woo_grouped_editor_support' );
function WPBC_woo_grouped_editor_support() { 
  $get_screen = get_current_screen();
  $current_screen = $get_screen->post_type; 
  if ($current_screen == 'product' && isset($_GET['post']) ) {  
		$product = wc_get_product( $_GET['post'] );
		if($product->get_type() == 'subscription'){
    	remove_post_type_support( $current_screen, 'editor' );   
    }
  }  
}