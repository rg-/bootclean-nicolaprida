<div class="text-center posts_pagination">
	<?php
	global $wp_query; 
	
	$paged = ( !empty($wp_query->query['paged']) ) ? $wp_query->query['paged'] : 0;
	$args = array( 

		'nav_class' => 'gpy-2 text-left',
		'prev_arrow' => '<i class="icon-arrow-left"></i>',
		'next_arrow' => '<i class="icon-arrow-right"></i>', 

		'use_pagination_arrows' => false,
		'ul_class' => 'pagination justify-content-center',
		'li_class' => 'page-item mx-2',
		'li_a_class' => 'btn btn-outline-light',
		'li_a_current_class' => 'btn btn-outline-light active',

		'paged' => $paged,
	);
	WPBC_advanced_posts_pagination($args); ?>
</div>