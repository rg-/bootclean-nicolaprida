<?php 
	$post_id = get_the_ID(); 
	$post_class = apply_filters('wpbc/filter/post/loop/class','col-lg-6 gmb-3 video-post rutinas-post'); 
 
	$featured_img_medium = get_the_post_thumbnail_url( get_the_ID(),'medium'); 
	$featured_img_medium_large = get_the_post_thumbnail_url( get_the_ID(),'medium_large');
	$featured_img_full = get_the_post_thumbnail_url( get_the_ID(),'full');

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?> data-is-inview="detect">

	<div class="post-favorite-absolute">[favorite-post-btn post_id="<?php echo get_the_ID(); ?>"]</div>

	<a href="<?php echo esc_url( get_permalink() ); ?>" class="d-block">
		<div class="hover_effect">
			<div class="embed-responsive embed-responsive-4by3">
				<div class="embed-responsive-item image-cover" data-is-inview-lazybackground="<?php echo $featured_img_medium_large; ?>" style="background-image: url(<?php echo $featured_img_medium; ?>); ">
				</div>
			</div>
		</div>
		<h6 class="gmt-1 section-title sm"><?php the_title(); ?></h6>
	</a>
	<div class="d-none">
		<div class="entry_meta">
			<?php get_template_part( 'template-parts/entry_meta' ); ?>
		</div>
	</div>
</article>
<!-- article #post-<?php the_ID(); ?> END -->