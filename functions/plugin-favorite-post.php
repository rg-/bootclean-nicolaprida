<?php
function get_favorites_count( $post_type = 'all', $user_id = 0 ){
    global $wpdb;  
    $table = $wpdb->prefix . 'favorite_post'; 
    $where = 'WHERE user_id = ';
    $where .= $user_id ? $user_id : get_current_user_id();
    $where .= $post_type == 'all' ? '' : " AND post_type = '$post_type'"; 
    $sql = "SELECT COUNT(*)
            FROM {$table}
            $where"; 
    $result = $wpdb->get_var( $sql ); 
    return $result;
}
function get_favorites( $post_type = 'all', $user_id = 0, $count = 4, $offset = 4 ) { 
	global $wpdb;  
    $table = $wpdb->prefix . 'favorite_post'; 
    $where = 'WHERE user_id = ';
    $where .= $user_id ? $user_id : get_current_user_id();
    $where .= $post_type == 'all' ? '' : " AND post_type = '$post_type'"; 
    $sql = "SELECT post_id, post_type
            FROM {$table}
            $where
            GROUP BY post_id
            ORDER BY post_type";

            // LIMIT $offset, $count

    $result = $wpdb->get_results( $sql ); 
    return $result;
}

function my_favorite_posts_FX( $atts, $content = null ) {
	extract(shortcode_atts(array( 
		'user_id' => '', 
		'count' => '',
		'post_type' => 'all',
		'include_btn' => false,
	), $atts));
	$content = '';
    ob_start(); 

    global $wp_query;
    $query_vars = $wp_query->query_vars; 
    $page = (!empty($query_vars['page'])) ? $query_vars['page'] : 1;
    $max_posts = get_favorites_count($post_type, $user_id);
    $posts_per_page = 4;
    // echo "page: $page - posts: $max_posts"; 
    include( get_stylesheet_directory() . '/template-parts/theme/my-favorite-posts.php' ); 
    $content .= ob_get_contents(); 
    ob_end_clean();
    return $content;
}
add_shortcode( 'my-favorite-posts', 'my_favorite_posts_FX' );