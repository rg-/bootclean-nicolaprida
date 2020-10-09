<?php 
	$post_class = apply_filters('wpbc/filter/post/single/class','');  
	$featured_img_low = get_the_post_thumbnail_url( get_the_ID(),'medium'); 
	$featured_img_hi = get_the_post_thumbnail_url( get_the_ID(),'full'); 
	$video = WPBC_get_field('archivo_de_video'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	
	[favorite-post-btn]

	<h2 class="gmb-2 section-title"><?php the_title(); ?></h2>

	<img class="w-100" src="<?php echo $featured_img_hi; ?>" alt=" "/> 
	
	<div class="gmt-2 gmb-1 entry-content">
		<?php the_content(); ?>
	</div>
	
	<hr class="bg-light gmb-1">

	<div class="videos-relacionados">
		<?php 

		$related_args = array(
			'post_type' => 'video',
			'orderby'=> 'post__in',
		);

		$videos_relacionados = WPBC_get_field('videos_relacionados'); 
		_print_code($videos_relacionados);
		if(!empty($videos_relacionados)){
			//$videos_relacionados = implode(', ', $videos_relacionados); 
			$related_args['post__in'] = $videos_relacionados;
		}
		
		$related = get_posts($related_args);
		if( $related && !empty($videos_relacionados) ) { 
			?>
			<h4 class="gpt-2 gmb-2">Videos que debes mirar para hacer esta rutina</h4>
			<div class="row">
			<?php
		    foreach( $related as $post ) {
	        setup_postdata($post); 
					$post_id = $post->ID;
					$post_class = apply_filters('wpbc/filter/post/loop/class','col-lg-4 gmb-2 video-post'); 
				 
					$featured_img_low = get_the_post_thumbnail_url( $post_id,'medium'); 
					$featured_img_hi = get_the_post_thumbnail_url( $post_id,'full'); 
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
				<a href="<?php echo esc_url( get_permalink($post_id) ); ?>" class="d-block hover_effect">
					<div class="embed-responsive embed-responsive-4by3">
						<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $featured_img_hi; ?>); ">
						</div>
					</div>
					<span class="btn btn-more sm"><img src="[WPBC_get_stylesheet_directory_uri]/images/theme/icon-play.png" width="60" alt=" "/></span>
				</a>
				<div class="gmt-1">
					<a href="<?php echo esc_url( get_permalink($post_id) ); ?>"  class="d-block"><h6 class="section-title xs"><?php the_title(); ?></h6></a> 
				</div>
			</article>
		  <?php
		    }
		    wp_reset_postdata();
		    ?>
		</div>
		    <?php
		}
	?>
</div>

	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/entry_meta' ); ?>
		<?php get_template_part( 'template-parts/link_pages' ); ?>
	</footer><!-- .entry-footer --> 
 
</article><!-- article#post-## -->

<div class="gpy-3">
	<?php
	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_front_page'];
	?>
	<a href="<?php echo get_permalink( $videos_front_page ); ?>" class="d-flex align-items-center"><span class="btn btn-light btn-more gmr-1"><i class="icon-arrow-left"></i></span> VOLVER AL LISTADO</a>
</div>