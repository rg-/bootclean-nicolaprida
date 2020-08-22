<?php 
	$post_class = apply_filters('wpbc/filter/page/single/class','');  
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>> 

	<?php if( apply_filters('WPBC_post_header_show',1) ) {?>
		<h2 class="gmb-2 section-title <?php echo apply_filters('WPBC_post_header_title_class',''); ?>"><?php the_title(); ?></h2>
	<?php } ?>
	
	<div class="<?php echo apply_filters('laprida/single/page/entry-content/class','gmt-2 gmb-1 entry-content'); ?>">
		<?php the_content(); ?>
	</div>
	
	<?php 
	$use_footer = apply_filters('laprida/single/page/footer',1);
	if($use_footer){
	?>
	<hr class="bg-light gmb-1"> 

	<footer class="entry-footer">
		<?php get_template_part( 'template-parts/entry_meta' ); ?>
		<?php get_template_part( 'template-parts/link_pages' ); ?>
	</footer><!-- .entry-footer --> 
 	<?php } ?>
</article><!-- article#post-## -->

<?php 
	$use_actions = apply_filters('laprida/single/page/actions',1);
	if($use_actions){
		get_template_part( 'template-parts/entry_actions' );
	}
 ?>