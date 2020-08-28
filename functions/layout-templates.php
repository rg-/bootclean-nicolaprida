<?php


add_filter('wpbc/body/class', 'custom_posts_body_class',10,1 ); 
function custom_posts_body_class($class){
	if(is_singular('post') || 'post' === get_post_type() || is_search()  ){
		$class .= ' single-header ';
	}
	if(if_is_rutinas_page() ){
		$class .= ' rutinas_front_page ';
	} 
	if(if_is_video_page()){
		$class .= ' video_front_page ';
	} 

	global $post;
	if( WPBC_if_has_page_header($post->ID) && WPBC_if_has_main_navbar($post->ID) ){
		$class .= ' single-header ';
	}

	return $class;
} 


/*

	Wrap content into <div class="row"....

*/ 

add_action('wpbc/layout/inner/content/loop/before', function(){ 
	if(!is_singular())	echo '<div class="row row-posts">';
});
add_action('wpbc/layout/inner/content/loop/after', function(){ 
	if(!is_singular())	echo '</div>';
});
add_action('wpbc/template/content/search/loop/before', function(){
	echo '<div class="row row-posts">';
});
add_action('wpbc/template/content/search/loop/after', function(){ 
	echo '</div>';
});


/*

	Change default template locations for each template, page, post, single, etc....

*/
add_filter('wpbc/filter/layout/locations', function($locations){
	if(if_is_rutinas_page()){
		$locations['_template_builder']['id'] = 'a2-ml'; 
		$locations['_template_builder']['args']['container_type'] = 'fixed'; 
	}
	if(if_is_video_page()){
		$locations['_template_builder']['id'] = 'a2-ml'; 
		$locations['_template_builder']['args']['container_type'] = 'fixed'; 
	}
	$locations['search']['id'] = 'a2-ml';
	$locations['404']['id'] = 'a2-ml';
	return $locations;  
}, 20,1 );

add_filter('wpbc/filter/layout/a2-ml/main_container/args', function($value){
	if( $value['id'] == 'main-container-areas' ){	
		$value['class'] = ' gpy-2 gpy-md-3 ';
	}
	if( $value['id'] == 'main-content-area' ){
		$value['class'] = ' col-lg-8 gpr-lg-4 ';  
	} 
	if( $value['id'] == 'area-1' ){
		$value['class'] = ' col-lg-4 ';  
	} 
	return $value;
},10,1); 

/*

	Modify the a2-ml content area (main) output

*/

add_filter('wpbc/filter/layout/a2-ml/content-area/shortcode/area-main', function($shortcode, $value){
	
	if( 'post' === get_post_type() && !is_singular()  && !is_search() ){ 
		$queried_object = get_queried_object(); 
		$shortcode = '<h2 class="section-title md rutinas-title"><a href="'.get_permalink( get_rutinas_front_page() ).'">Rutinas</a><br class="d-sm-none"><span class="d-none d-sm-inline-block">/</span>'.$queried_object->name.'</h2>'.$shortcode;
	}  

	if(is_tax('tag-video') || is_tax('categoria-video')){
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$shortcode = '<h2 class="section-title md videos-title"><a href="'.get_permalink( get_videos_front_page() ).'">Biblioteca</a><br class="d-sm-none"><span class="d-none d-sm-inline-block">/</span>'.$term->name.'</h2>'.$shortcode;
	}


	if( if_is_rutinas_page() ){
		$shortcode .= do_shortcode('[rutinas_loop]');
	}

	if(if_is_video_page()){
		$shortcode .= do_shortcode('[video_loop]');
	}

	return $shortcode;
},10,2); 

/*

	Use some other ID for the "secondary-content" area if something....

*/

add_filter('wpbc/filter/layout/secondary-content/post_id', function($post_id){ 

	$queried_object = get_queried_object();
	if(!empty($queried_object)){
		// print_r($queried_object);
		if( $queried_object->taxonomy=='category' || $queried_object->taxonomy=='post_tag' ){
			$post_id = get_rutinas_front_page();
		}
		if( $queried_object->taxonomy=='categoria-video' || $queried_object->taxonomy=='tag-video' ){
			$post_id = get_videos_front_page();
		}
	}

	if( is_singular('post') ){
		$post_id = get_rutinas_front_page();
	}
	if( is_page( get_rutinas_front_page() ) ){
		$post_id = get_rutinas_front_page(); 
	}

	if( is_singular('video') ){
		$post_id = get_videos_front_page();
	}
	if( is_page( get_videos_front_page() ) ){
		$post_id = get_videos_front_page(); 
	}

	if( is_search() ){
		//$post_id = get_rutinas_front_page();
	}

	return $post_id;
},20,1); 




/*

	Filter main-page-header arguments if....

*/


add_filter('wpbc/filter/layout/main-page-header/defaults',function($defaults){ 

	$template_id = $defaults['template_id'];

	$queried_object = get_queried_object();
	if(!empty($queried_object)){
		// print_r($queried_object);
		if( $queried_object->taxonomy=='category' || $queried_object->taxonomy=='post_tag' ){
			$template_id = get_rutinas_layout_header_template();  
		}
		if( $queried_object->taxonomy=='categoria-video' || $queried_object->taxonomy=='tag-video' ){
			$template_id = get_videos_layout_header_template();   
		}
	}

	if( is_singular('post') ){
		$template_id = get_rutinas_layout_header_template();  
	}
	if( is_singular('video') ){ 
		$template_id = get_videos_layout_header_template();   
	}

	if( is_search() ){
		$template_id = get_rutinas_layout_header_template();  
	}

	$defaults['template_id'] = $template_id; 
	return $defaults;  
},30,1); 