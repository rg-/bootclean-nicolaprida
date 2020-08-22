<?php

add_filter('wpbc/filter/woocommerce/config', function ($wpbc_woocommerce_config){
	
	$wpbc_woocommerce_config['layout']['cart'] = array(
		'class' => ' ',
	); 
	
	return $wpbc_woocommerce_config;

},10,1);

add_action('wpbc/layout/start', function(){   
	
	if( is_cart() ){
		remove_action('wpbc/layout/start', 'theme_custom_search_form',39);
	} 

},0);

add_filter('laprida/single/page/footer',function($use){
	if( is_cart() ){
		$use = false;
	}
	return $use; 
},10,1);  
add_filter('laprida/single/page/actions',function($use){
	if( is_cart() ){
		$use = false;
	}
	return $use; 
},10,1);  

add_filter('WPBC_post_header_show', function($show){
	if( is_cart() ){
		$show = false;
	}
	return $show; 
},10,1); 