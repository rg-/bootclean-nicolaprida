<?php 
	$post_class = apply_filters('wpbc/filter/post/search/class','col-12'); 
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>

	<?php do_action('wpbc/template/content/search/result/before'); ?>

	<header class="entry-header">
		<p class="lead"><?php echo __('Sorry what you are looking at does not exist or an error occurred.', 'bootclean'); ?></p>
		<p><?php echo __('Try again later or use a diferent search combination.', 'bootclean'); ?></p>
	</header>
	
	<?php do_action('wpbc/template/content/search/result/after'); ?>
	
</article><!-- article#post-## -->
