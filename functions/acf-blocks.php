<?php 

/*

	TODO, start passing this to bootclean core instead
	
	Use rule:

		block name (id):
			'wpbc_[name]'
		template part: 
			'template-parts/blocks/wpbc_[name]/wpbc_[name].php',
 

*/

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {

  add_action('acf/init', 'register_acf_block_types'); 

  function register_acf_block_types() { 
    // register a testimonial block.
    acf_register_block_type(array(
        'name'              => 'wpbc_slick',
        'title'             => __('Slick slider gallery'),
        'description'       => __('A custom image slider gallery block.'),
        'render_template'   => 'template-parts/blocks/wpbc_slick/wpbc_slick.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'slider', 'gallery' ),
    ));
	}

	/* BLOCK END */

}