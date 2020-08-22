<?php 
	$post_class = apply_filters('wpbc/filter/post/search/class','col-12 gmb-1 video-post search-post'); 
	$featured_img_low = get_the_post_thumbnail_url( get_the_ID(),'medium'); 
	$featured_img_hi = get_the_post_thumbnail_url( get_the_ID(),'full');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>> 

	<?php do_action('wpbc/template/content/search/result/before'); ?>
	
	<div class="entry-content gmy-1">

		<div class="row row-half-gutters">

			<div class="col-md-3 col-lg-3 position-relative pt-md-2 gmb-1 mb-md-0">
				<div class="post-favorite-absolute d-md-none">[favorite-post-btn post_id="<?php echo get_the_ID(); ?>"]</div>
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="d-block">
					<div class="hover_effect">
						<div class="embed-responsive embed-responsive-4by3">
							<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $featured_img_low; ?>); ">
							</div>
						</div> 
					<?php 
					if( 'video' === get_post_type() ){
						?>
						<span class="btn btn-more sm"><img src="[WPBC_get_stylesheet_directory_uri]/images/theme/icon-play.png" width="60" alt=" "/></span><?php
					} 
					?>
					</div>
				</a>
			</div>
			<div class="col-md-9 col-lg-9 gpr-lg-4">
				<div class="post-favorite-small d-none d-md-block">[favorite-post-btn post_id="<?php echo get_the_ID(); ?>"]</div>
				<h6 class="section-title sm"><a href="<?php echo esc_url( get_permalink() ); ?>" class="d-block"><?php 
				if( 'post' === get_post_type() ){
					echo "<small class='t'>RUTINAS</small><br>";
				}
				if( 'video' === get_post_type() ){
					echo "<small class='t'>VIDEOS</small><br>";
				} 
				?><?php the_title(); ?></a></h6>
				<?php WPBC_excerpt(array(
					'class' => 'small gmb-1',
					'readmore' => false,
				));  ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-outline-light btn-xs">VER MÁS</a>
				<div class="mt-1 d-none">
					<?php get_template_part( 'template-parts/entry_meta' );  ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php do_action('wpbc/template/content/search/result/after'); ?>

</article><!-- article#post-## -->
