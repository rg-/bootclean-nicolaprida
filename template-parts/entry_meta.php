<?php if ( 'post' === get_post_type() ) { ?>
	<div class="entry-meta">
		<?php echo WPBC_get_the_terms(array(
			'taxonomy' => 'category',
		'post_id'=> get_the_ID(),
		'before' => '',
		'sep' => '',
		'term_class' => 'btn btn-outline-light btn-xs',
	)); ?>
	</div>
	<?php if ( is_single() ) { ?>
	<div class="entry-meta mt-2">
		<?php echo WPBC_get_the_terms(array(
			'taxonomy' => 'post_tag',
		'post_id'=> get_the_ID(),
		'before' => '',
		'sep' => '',
		'term_class' => 'btn btn-outline-light btn-xs',
	)); ?>
	</div>
	<?php } ?>
<?php } ?>

<?php if ( 'video' === get_post_type() ) { ?>
	<div class="entry-meta">
		<?php echo WPBC_get_the_terms(array(
			'taxonomy' => 'categoria-video',
		'post_id'=> get_the_ID(),
		'before' => '',
		'sep' => '',
		'term_class' => 'btn btn-outline-light btn-xs',
	)); ?>
	</div>
	<?php if ( is_single() ) { ?>
	<div class="entry-meta mt-2">
		<?php echo WPBC_get_the_terms(array(
			'taxonomy' => 'tag-video',
		'post_id'=> get_the_ID(),
		'before' => '',
		'sep' => '',
		'term_class' => 'btn btn-outline-light btn-xs',
	)); ?>
	</div>
	<?php } ?>
<?php } ?>