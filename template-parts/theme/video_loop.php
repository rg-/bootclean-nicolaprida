<div class="row row-posts">
<?php

	global $wp_query; 
	
	$paged = ( !empty($wp_query->query['paged']) ) ? $wp_query->query['paged'] : 0;

  $temp = $wp_query; 
  $wp_query = null; 

  $query = array(
			'post_type' => 'video',
			'posts_per_page' => get_option('posts_per_page'),
			'paged' => $paged, 
			'order' => 'ASC',
			'orderby' => 'date', 
		);
  $wp_query = new WP_Query($query); 
  // $wp_query->query('showposts=6&post_type=video'.'&paged='.$paged); 

  while ($wp_query->have_posts()) { 
  	$wp_query->the_post();  
  	?>
  	<?php get_template_part( 'template-parts/content-video' ); ?> 
  	<?php
  }
?>
</div>

<div class="text-center">
	<?php
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

<?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset
?>