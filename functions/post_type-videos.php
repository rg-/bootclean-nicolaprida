<?php

function WPBC_create_video_post_type() { 


	// Enable this type for the Private metabox
	add_filter('wpbc/filter/private_areas/location_post_types', function($location_post_types){
		$location_post_types[] = 'video'; 
		return $location_post_types;
	},10,1);


	$labels = array(
		'name' => _x('Video', 'nicolaprida'),
		'singular_name' => _x('Video', 'nicolaprida'),
		'add_new' => _x('Agregar Video', 'nicolaprida'),
		'add_new_item' => __('Nuevo Video'),
		'edit_item' => __('Editar Video'),
		'new_item' => __('Nuevo Video'),
		'all_items' => __('Todos los Videos'),
		'view_item' => __('Ver Video'),
		'search_items' => __('Buscar Videos'),
		'not_found' =>  __('No encontrado/s'),
		'not_found_in_trash' => __('No hay videos'), 
		'parent_item_colon' => '',
		'menu_name' => 'Videos', 
	);
	$args = array(
		'labels' => $labels,
		'description' => 'A post type for entering video information.',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'hierarchical' => true,
		'supports' => array('title','editor','thumbnail'),
		'rewrite' => array(
			'slug' => 'video',
			'with_front' => false,
		),
		'has_archive' => true,
		'menu_icon' => 'dashicons-welcome-view-site',
		'menu_position' => 6,
	);
	register_post_type('video',$args);

	register_taxonomy(
		'categoria-video',
		array( 'video' ),
		array(
			'label' => __('Categoria Video','nicolaprida'),
			'labels' => array(
				'add_new_item' => __('Agregar Categoria Video','nicolaprida'),
			),  
			
			'public' => true, 
			'hierarchical' => true,
			'sort' => true,
			'show_ui' => true,
		      'show_in_quick_edit' => true,
		      //'meta_box_cb' => 'post_categories_meta_box',
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			//'rewrite' => false, 
			'query_var' => false, 
			'rewrite' => array( 'slug' => 'categoria-video', 'with_front' => true ),
		)
	);

	register_taxonomy(
		'tag-video',
		array( 'video' ),
		array(
			'label' => __('Tag Video','nicolaprida'),
			'labels' => array(
				'add_new_item' => __('Agregar Categoria Video','nicolaprida'),
			),  
			
			'public' => true, 
			'hierarchical' => false,
			'sort' => true,
			'show_ui' => true,
		  'show_in_quick_edit' => true,
		  'update_count_callback' => '_update_post_term_count',
			'show_in_nav_menus' => true,
			'show_admin_column' => true, 
			'query_var' => false, 
			'rewrite' => array( 'slug' => 'tag-video', 'with_front' => true ),
		)
	); 

}
add_action( 'init', 'WPBC_create_video_post_type' );

// add_action('init','my_rewrite_rules');
function my_rewrite_rules(){
    // Replace custom_post_type_slug with the slug of your custom post type
    add_rewrite_rule( 'video/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(.+)/?$', 'index.php?video='.$matches[4], 'top' );
}


function add_post_tag_columns($columns){
    $columns['image'] = 'Imágen';
    return $columns;
}
add_filter('manage_edit-category_columns', 'add_post_tag_columns');
add_filter('manage_edit-categoria-video_columns', 'add_post_tag_columns');

function add_post_tag_column_content($value, $column_name, $tax_id ){
	if ( $column_name === 'image' ) {
		$img = get_field('imagen','category_'.$tax_id.''); 
		echo "<img src='".$img."' width='50'/>"; 
	} 
}
add_filter('manage_category_custom_column', 'add_post_tag_column_content',0,3);
add_filter('manage_categoria-video_custom_column', 'add_post_tag_column_content',0,3);

 


/* Template part filters/shortcodes etc */

function video_loop_FX($atts, $content = null){
	extract(shortcode_atts(array(  
		'class' => 'video_loop',
	), $atts));

	$out = '<div class="'.$class.'">'; 
	$out .= '[WPBC_get_template name="theme/video_loop"]';
	$out .= '</div>';
	return $out;
}
add_shortcode('video_loop','video_loop_FX'); 


function get_videos_front_page(){
	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_front_page'];
	return $videos_front_page;
}
function get_videos_layout_header_template(){
	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_layout_header_template'];
	return $videos_front_page;
}
function if_is_video_page(){
	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_front_page'];
	global $post; 
	if( !empty($post) && $post->ID===$videos_front_page){
		return true;
	}else{
		return false;
	}
} 



/*

	ACF FIELDS

*/


	if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5e83bbc7f0317',
	'title' => 'Imágen Categoría',
	'fields' => array(
		array(
			'key' => 'field_5e83bbf788be3',
			'label' => 'Imágen',
			'name' => 'imagen',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'category',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'post_tag',
			),
		),
		array(
			array(
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'categoria-video',
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

acf_add_local_field_group(array(
	'key' => 'group_5e8141bddeeda',
	'title' => 'Media',
	'fields' => array(
		array(
			'key' => 'field_5e8141d048df1',
			'label' => 'Archivo de Video',
			'name' => 'archivo_de_video',
			'type' => 'file',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array( 
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'video',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;