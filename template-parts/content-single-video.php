<?php 
	$post_class = apply_filters('wpbc/filter/post/single/class','');  
	$featured_img_low = get_the_post_thumbnail_url( get_the_ID(),'medium'); 
	$featured_img_hi = get_the_post_thumbnail_url( get_the_ID(),'full'); 
	$video = WPBC_get_field('archivo_de_video'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	
	[favorite-post-btn]

	<h2 class="gmb-2 section-title"><?php the_title(); ?></h2>

	<div class="image-cover" style="background-image: url(<?php echo $featured_img_hi; ?>); ">
		<video oncontextmenu="return false;" controls controlsList="nodownload" class="d-block w-100" poster="[WPBC_get_stylesheet_directory_uri]/images/theme/trans.png"> 
		  <source src="<?php echo $video['url'];?>" type="video/mp4">
		</video>
	</div>
	
	<div class="gmy-2 entry-content">
		<?php the_content(); ?>
	</div>
	
	<hr class="bg-light gmb-2">

	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/entry_meta' ); ?>
		<?php get_template_part( 'template-parts/link_pages' ); ?>
	</footer><!-- .entry-footer --> 
 
</article><!-- article#post-## -->

<div> 

<div class="videos-relacionados">
		<?php
		$terms = get_the_terms( get_the_ID() , 'categoria-video' );
		
		if ( $terms && ! is_wp_error( $terms ) ) { 
				$temp = array();
				foreach ( $terms as $term ) {
					$temp[] = $term->term_id;
				}
			}
			$temp = implode(', ', $temp);  
			$related = get_posts( 
		    array(
		    		'post_type' => 'video', 
		        'tax_query' => array(
						    array(
						      'taxonomy' => 'categoria-video',
						      'terms' => array($temp),
						      'field' => 'term_id', 
						    )
						  ),
		        'numberposts'  => 3, 
		        'post__not_in' => array( get_the_ID() ) 
		    ) 
		);
		if( $related ) { 
			?>
			<h4 class="gpt-2 gmb-2">Videos relacionados</h4>
			<div class="row">
			<?php
		    foreach( $related as $post ) {
		        setup_postdata($post);
		        ?>

<?php 
	$post_id = $post->ID;
	$post_class = apply_filters('wpbc/filter/post/loop/class','col-lg-4 gmb-3 video-post'); 
 
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
	<div class="gmt-2">
		<a href="<?php echo esc_url( get_permalink($post_id) ); ?>"  class="d-block"><h6 class="section-title sm"><?php the_title(); ?></h6></a> 
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

</div>

<div class="gpy-3">
	<?php
	$settings_posts = get_field('settings_posts','options');
	$videos_front_page = $settings_posts['videos_front_page'];
	?>
	<a href="<?php echo get_permalink( $videos_front_page ); ?>" class="d-flex align-items-center"><span class="btn btn-light btn-more gmr-1"><i class="icon-arrow-left"></i></span> VOLVER AL LISTADO</a>
</div>