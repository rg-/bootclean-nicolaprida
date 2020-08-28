<?php

add_filter('wpbc/filter/layout/go-up', 'custom_goUp',10,1);
function custom_goUp($html){
	return '<a href="#" class="btn btn-transparent"><i class="fa fa-angle-up"></i></a>'; 
} 

add_filter('wpbc/body/class', 'custom_body_class',10,1 ); 
function custom_body_class($class){
	$class .= ' uielements-white ';
	return $class;
}

add_filter('wpbc/body/data', 'custom_body_data',10,1 ); 

function custom_body_data($out){
	global $post;
	$layout_main_navbar_fixed_lol = WPBC_get_field('layout_main_navbar_fixed_lol', $post->ID); 
	if($layout_main_navbar_fixed_lol){
		$out = ' data-scroll-offset="120" data-scroll-time-1="100" data-scroll-ease-1="easeOutBack" data-loader-delay="1000"'.$out;
	}else{
		$out = ' data-scroll-offset="63" data-scroll-time-1="100" data-scroll-ease-1="easeOutBack" data-loader-delay="1000"'.$out;
	}
	
	return $out;
}

/*

	wpbc/filter/layout/start/defaults

*/
add_filter('wpbc/filter/layout/start/defaults', function($args){ 
	$args['main_content']['wrap']['class'] = '';
	return $args;
});
 

/*

	Insert WPBC_my_search_form( $form ) 
	on top for every page template

	(responsive mobile show only)

*/

add_action('wpbc/layout/start', 'theme_custom_search_form',39);
function theme_custom_search_form(){
	$landing_page_id = WPBC_get_field('landing_page','options'); 
	if(!is_page($landing_page_id) ){ 
		echo '<div class="container d-lg-none"><div class="row"><div class="col-12 gmb-2">'.WPBC_my_search_form( '' ).'</div></div></div>'; 
	}else{

	}
}


/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function WPBC_my_search_form( $form ) {
    $form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
    <div class="form-group m-0">
    <input placeholder="Buscar" class="search-field" type="text" value="' . get_search_query() . '" name="s" />
    <button type="submit" class="searchsubmit"><i class="fa fa-search"></i></button> 
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'WPBC_my_search_form' ); 
  

function default_blog_post_id($post_id){ 
	global $wp_query;
	global $post;

	// $template = WPBC_get_template();
	// $layout = WPBC_get_layout_structure_build_layout($post_id);

	if(!empty($wp_query->is_posts_page)){
		$post_id = get_option('page_for_posts');
	}
	$post_type = get_post_type($post);
	if(is_single() && $post_type == 'post'){ 
		$post_id = get_option('page_for_posts');
	}
	if(is_archive() && $post_type == 'post'){
		$post_id = get_option('page_for_posts');
	} 
	return $post_id;
}  

/*

*/

add_filter('wpbc/filter/layout/secondary-content/post_id', function($post_id){ 
	//$post_id = default_blog_post_id($post_id);
	return $post_id;
},10,1);

/*


	<div data-toggle="scroll-affixme" data-affix-target="#main-container-areas" data-affix-offset-target="#main-navbar">'.$value['content-area']['shortcode'].'</div>

	Adding a custom page header for singular posts, use in this case a shortcode that will load a template-part/

*/
 
/*
	area-main
	area-1
	area-2
*/

add_filter('wpbc/filter/layout/a2-ml/content-area/shortcode/area-1', 'custom_content_areas',10,2);
function custom_content_areas($shortcode, $value){
	if ( is_active_sidebar( 'widget_area_1' ) ){
		// $shortcode = dynamic_sidebar( 'widget_area_1' );
	}
	
	return $shortcode; 
}

add_filter('wpbc/filter/get_query_posts/template_args', function($template_args, $query){
	/*
	'template_part' => 'content', // For the loop
		'template_part_single' => 'content-single', // For Single
		
		'target_id' => !empty($query['target_id']) ? $query['target_id'] : $default_target_id,
		'target_nav_id' => !empty($query['target_id']) ? $query['target_id'].'-nav' : $default_target_id.'-nav',
		
		'target_class' => 'row gmy-1', 
		'target_nav_class' => '',
		'target_nav_ul_class' => 'pagination justify-content-center',
		
		'pagination_load_more' => __( 'Load more', 'bootclean' ),
		'pagination_no_results' => __( 'No more post to load', 'bootclean' ),
		'pagination_not_found_posts' => __( 'Not found posts', 'bootclean' ),
		'pagination_showing' => __( 'Showing %u of %u.', 'bootclean' ), 
	*/
	$template_args['template_part'] = 'content-post';
	return $template_args;
},10,2);


// add_filter( 'WPBC_posts_pagination__defaults', 'custom_WPBC_posts_pagination__defaults', 10, 1 );
function custom_WPBC_posts_pagination__defaults($defaults){
	$defaults['screen_reader_text'] = 's';
	return $defaults;
} 