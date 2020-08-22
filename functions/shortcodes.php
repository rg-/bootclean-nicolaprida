<?php

// Show or hide content based on whether user is logged in or not
// shortcode for logged in users is [loggedin]content[/loggedin]
// shortcode for logged out users us [loggedout]content[/loggedout]

if( ! function_exists( 'current_user_has_role' ) ){
    function current_user_has_role( $role ) {

        $user = get_userdata( get_current_user_id() );
        if( ! $user || ! $user->roles ){
            return false;
        }

        if( is_array( $role ) ){
            return array_intersect( $role, (array) $user->roles ) ? true : false;
        }

        return in_array( $role, (array) $user->roles );
    }
}

function loggedincheck( $atts, $content = null ) {
	extract(shortcode_atts(array( 
		'role' => 'read', 
		'not_role' => '',
	), $atts));
   if ( is_user_logged_in() && !is_null( $content ) && !is_feed() ) {
   	if( !empty($not_role) ){
   		if( !current_user_can( $not_role ) && current_user_can( $role ) ){
   			return $content; 
   		}
   	}else{
   		if(current_user_can( $role )){
   			return $content; 
   		}
   	}
        
   }
}
add_shortcode( 'loggedin', 'loggedincheck' );

function loggedoutcheck( $atts, $content = null ) {
     if ( !is_user_logged_in() && !is_null( $content ) && !is_feed() ) {
          return $content;
     return '';
     }
}
add_shortcode( 'loggedout', 'loggedoutcheck' );

function esports_news_title_FX($atts, $content = null){
	extract(shortcode_atts(array( 
	), $atts));

	$out = 'Noticias';
	if(!is_home()){
		$out .= ' / '. get_the_archive_title();
	}

	return $out;
}
add_shortcode('esports_news_title','esports_news_title_FX');


function esports_news_nav_FX($atts, $content = null){
	extract(shortcode_atts(array( 
		'taxonomy' => 'category',
		'label' => 'Categorias',
		'class' => 'd-inline-block gpr-1',
	), $atts));
 
 	$out = '<div class="'.$class.'">';
	$out .= $label.': ';
	$tax = get_categories('taxonomy='.$taxonomy.'');
	foreach($tax as $term){
    if($term->count > 0){
        $out.= "<a class='ml-3' href='".get_term_link($term)."'>".$term->name."</a>";
    }
  } 
  $out .= '</div>';
	return $out;
}
add_shortcode('esports_news_nav','esports_news_nav_FX'); 


function category_thumbs_FX($atts, $content = null){
	extract(shortcode_atts(array( 
		'taxonomy' => 'category',
		'label' => '',
		'class' => 'row row-half-gutters gpr-1 category_thumbs',
	), $atts));
 
 	$out = '<div class="'.$class.'">';

 	$args = array(
		'taxonomy'=> $taxonomy,
		'orderby'=> 'name',
		'order' => 'ASC', 
	);  

 	if($taxonomy == 'tag-video'){
 		$args['orderby'] = 'count';
 		$args['order'] = 'DESC';
 		$args['number'] = 15;  // Limit
 	}else{
 		
 	}

 	$tax = get_categories($args);
 	
	foreach($tax as $term){
    if($term->count > 0){
    	$img = get_field('imagen','category_'.$term->term_id.'');
    	if($img){
        $out.= "<div class='col-6 col-md-4 col-lg-6 gmb-1'><div class='embed-responsive embed-responsive-4by3'><a class='category_thumb embed-responsive-item image-cover d-flex align-items-center justify-content-center font-gilroyeb' style='background-image:url(".$img.");' href='".get_term_link($term)."'><span>".$term->name."</span></a></div></div>";
    	}else{
    		$out.="<a class='btn btn-outline-light btn-xs mr-2 mb-2' href='".get_term_link($term)."'><span>".$term->name."</span></a>";
    	}
    }
  } 
 	$out .= '</div>';
	return $out;
}
add_shortcode('category_thumbs','category_thumbs_FX');   

function featured_videos_FX($atts, $content = null, $tag){
	extract(shortcode_atts(array( 
		'label' => '',
		'class' => 'featured_videos',
	), $atts));

	if($tag=='featured_videos'){
		$settings_posts = get_field('settings_posts','options');
		$featured_videos = $settings_posts['featured_videos'];
		$taxonomy = 'categoria-video';
	}
	if($tag=='featured_rutinas'){
		$settings_posts = get_field('settings_rutinas','options');
		$featured_videos = $settings_posts['featured_rutinas'];
		$taxonomy = 'category';
	}

	$out = '';
	if(!empty($featured_videos)){

		$out = '<div class="'.$class.'">';
	  
		foreach ($featured_videos as $key => $value) {
			$featured_img_low = get_the_post_thumbnail_url( $value,'medium'); 

			$cats = WPBC_get_the_terms(array(
				'taxonomy' => $taxonomy,
				'post_id'=> $value,
				'before' => '',
				'sep' => '',
				'before_name' => '<u class="btn-xs">',
				'after_name' => '</u>',
				'use_links' => false,
			));

			$out .= '<a href="'.get_the_permalink($value).'" class="featured_video row row-half-gutters align-items-center gmy-2">';
			$out .= '<div class="col-5 position-relative"><img src="'.$featured_img_low.'" alt=" " />';
			if( $tag=='featured_videos' ){
				$out .= '<span class="btn btn-more sm"><img src="[WPBC_get_stylesheet_directory_uri]/images/theme/icon-play.png" width="60" alt=" "/></span>';
			}
			$out .= '</div>';
			$out .= '<div class="col-7"><span class="title font-gilroyem">'.get_the_title($value).'</span><br>'.$cats.'</div>';

			$out .= '</a><hr class="bg-light">';
		}
		$out .= '</div>';

	}
	return $out;
}
add_shortcode('featured_rutinas','featured_videos_FX'); 
add_shortcode('featured_videos','featured_videos_FX');  


function btn_lg_scroll_FX($atts, $content = null, $tag){
	extract(shortcode_atts(array( 
		'label' => 'button',
		'color' => 'primary',
		'href' => '#',
	), $atts));

	return '<a href="'.$href.'" class="btn btn-lg btn-'.$color.'">'.$label.'</a>';
}
add_shortcode('btn_lg_scroll','btn_lg_scroll_FX'); 