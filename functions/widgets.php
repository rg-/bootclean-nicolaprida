<?php


add_filter('WPBC_widgets_init__defaults', function($defatuls_widgets){


	$before_title = apply_filters('wpbc/filter/widgets/before_title', '<h4 class="section-title">');
	$after_title = apply_filters('wpbc/filter/widgets/after_title', '</h4>'); 

	$defatuls_widgets[] = array(
			'name'          => 'Widget Area 3',
			'id'            => 'widget_area_3',
			'description'   => '',
			'class'         => 'wpbc-widget', // ?? This one is a myst?
			'before_widget' => '<div class="widget-box">',
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title,
	);

	$defatuls_widgets[] = array(
			'name'          => 'Widget Area 4',
			'id'            => 'widget_area_4',
			'description'   => '',
			'class'         => 'wpbc-widget', // ?? This one is a myst?
			'before_widget' => '<div class="widget-box">',
			'after_widget'  => '</div>',
			'before_title'  => $before_title,
			'after_title'   => $after_title,
	);

	return $defatuls_widgets;
},10,1);


add_action('WPBC_layout__inner_col_sidebar__after',function(){
	$widget = 'widget_area_3'; 
	if ( is_search() && !empty($widget) && is_active_sidebar( $widget ) ){
		dynamic_sidebar( $widget );
	}
},10);