<?php

function rutinas_loop_FX($atts, $content = null){
	extract(shortcode_atts(array(  
		'class' => 'video_loop rutinas_loop',
	), $atts));

	$out = '<div class="'.$class.'">'; 
	$out .= '[WPBC_get_template name="theme/rutinas_loop"]';
	$out .= '</div>';
	return $out;
}
add_shortcode('rutinas_loop','rutinas_loop_FX');

function get_rutinas_front_page(){
	$settings_posts = get_field('settings_rutinas','options');
	$videos_front_page = $settings_posts['rutinas_front_page'];
	return $videos_front_page;
}
function get_rutinas_layout_header_template(){
	$settings_posts = get_field('settings_rutinas','options');
	$videos_front_page = $settings_posts['rutinas_layout_header_template'];
	return $videos_front_page;
}
function if_is_rutinas_page(){
	$settings_posts = get_field('settings_rutinas','options');
	$videos_front_page = $settings_posts['rutinas_front_page'];
	global $post; 
	if( !empty($post) && $post->ID===$videos_front_page){
		return true;
	}else{
		return false;
	}
} 



add_filter( 'post_type_labels_post', 'news_rename_labels' );

/**
* Rename default post type to news
*
* @param object $labels
* @hooked post_type_labels_post
* @return object $labels
*/
function news_rename_labels( $labels )
{
    # Labels
    $labels->name = 'Rutinas';
    $labels->singular_name = 'Rutina';
    $labels->add_new = 'Agregar Rutina';
    $labels->add_new_item = 'Nueva Rutina';
    $labels->edit_item = 'Editar Rutina';
    $labels->new_item = 'Nueva Rutina';
    $labels->view_item = 'Ver Rutina';
    $labels->view_items = 'Ver Rutina';
    $labels->search_items = 'Buscar Rutinas';
    $labels->not_found = 'No rutinas encontradas.';
    $labels->not_found_in_trash = 'No rutinas encontradas en la papelera.';
    $labels->parent_item_colon = 'Parent Rutinas'; // Not for "post"
    $labels->archives = 'Rutinas Archivo';
    $labels->attributes = 'Rutinas Attributos';
    $labels->insert_into_item = 'Insertar en Rutinas';
    $labels->uploaded_to_this_item = 'Subido a esta Rutina';
    $labels->featured_image = 'Imagen destacada';
    $labels->set_featured_image = 'Elegir Imagen destacada';
    $labels->remove_featured_image = 'Borrar Imagen destacada';
    $labels->use_featured_image = 'Usar como Imagen destacada';
    $labels->filter_items_list = 'Filtrar listado de Rutinas';
    $labels->items_list_navigation = 'Rutinas listado de navegación';
    $labels->items_list = 'Listado de Rutinas';

    # Menu
    $labels->menu_name = 'Rutinas';
    $labels->all_items = 'Todas las Rutinas';
    $labels->name_admin_bar = 'Rutinas';

    return $labels;
}


add_action('init', 'rename_taxonomies');
function rename_taxonomies() {
    global $wp_taxonomies;

    $cat = $wp_taxonomies['category'];
    $cat->label = 'Categorias Rutina';
    $cat->labels->singular_name = 'Categoría Rutina';
    $cat->labels->name = $cat->label;
    $cat->labels->menu_name = $cat->label; 

    $tag = $wp_taxonomies['post_tag'];
    $tag->label = 'Tags Rutina';
    $tag->labels->singular_name = 'Tag Rutina';
    $tag->labels->name = $tag->label;
    $tag->labels->menu_name = $tag->label; 
}


if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_5ef19a9d4ce93',
    'title' => 'Ajustes de la Rutina',
    'fields' => array(
        array(
            'key' => 'field_5ef19ac310034',
            'label' => 'Videos relacionados',
            'name' => 'videos_relacionados',
            'type' => 'relationship',
            'instructions' => 'Utiliza "Selecciona Taxonomía" para filtar los Videos por categorias o tags.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array(
                0 => 'video',
            ),
            'taxonomy' => '',
            'filters' => array(
                0 => 'search', 
                2 => 'taxonomy',
            ),
            'elements' => '',
            'min' => '',
            'max' => '',
            'return_format' => 'id',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post',
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

endif;