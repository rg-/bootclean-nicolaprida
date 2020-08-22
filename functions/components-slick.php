<?php
add_filter('wpbc/slick/slick_class',function($class){ 
	$class .= ' animated ';
	return $class;
}); 
add_filter('wpbc/slick/slick_data',function($attrs){  
	return $attrs;
}); 

/*

	Set the default "item_type" value for Sider component

*/
	
add_filter('acf/load_field/key=key__r_slider_item__type', function($field){

	$field['default_value'] = "cover";
	return $field;

});

/*

	Set the default "item_content" class value for Sider component

*/
	
add_filter('acf/load_field/key=key__slider__classes_item_content', function($field){

	$field['default_value'] = "d-flex justify-content-center align-items-end align-items-lg-center";
	return $field;

});

/*

	Change content slide html output

*/

// add_filter('wpbc/slick/content_slide', 'eSports_custom_content_slide', 10, 1);

function eSports_custom_content_slide($content_slide){

	if(!empty($content_slide)){
		$content_slide = '<div class="container"><div class="row"><div class="col-md-9 slick_content"><div data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOutDown" data-animation-duration=".6s"><h2 class="slider-title">'.$content_slide.'<a data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOutDown" data-animation-duration=".6s" data-animation-delay="1s" class="icon_arrow down scroll-to" href="#empresa"></a></h2></div></div></div></div>'; 
	}
	
	return $content_slide; 

}