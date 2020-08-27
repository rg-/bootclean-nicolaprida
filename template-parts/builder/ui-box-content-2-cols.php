<?php 
/*

	$post_id passed
	$layout_count passed

*/ 

$layout_prefix = 'ui-box-content-2-cols'; 

$section = WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id);  

// _print_code($section);

if(empty($section['section_visible'])){
	$style = '';
	$section_background_image = $section['section_background_image'];
	if(!empty($section_background_image)){
		$style = 'background-image: url([WPBC_get_attachment_image_src id='. $section_background_image['id'] .']);';
	}
?>
<div id="<?php echo $section['section_id']; ?>" class="image-cover gpy-2 gpy-md-6 bg-<?php echo $section['section_style_background']; ?> text-<?php echo $section['section_style_color']; ?>" style="<?php echo $style; ?>">

	<?php if(!empty( $section['section_title'] )){ ?>
	<div class="container" data-is-inview="detect">
		<div class="row">
			<div class="col-12 text-center">
				<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
					<h2 class="section-title md font-gilroyeb"><?php echo $section['section_title']; ?></h2>
				</div>
				<?php if(!empty( $section['section_subtitle'] )){ ?>
					<div data-is-inview-fx="fadeInUp" data-transition-delay=".6s">
						<h2 class="section-title sm font-gilroyeb"><?php echo $section['section_subtitle']; ?></h2>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="container">
	<?php
	$items = get_sub_field('field_'.$layout_prefix.'__'.'items', $post_id);
	if(!empty($items)){ 
		foreach ($items as $key => $value) {
			# code...
			?>
<div class="row gmy-3 gpb-1">
	<div class="col-md-5 gpr-md-3">
		<?php

		$img = $value[$layout_prefix.'__'.'item_image'];

		$featured_img_low = wp_get_attachment_image_src( $img['id'],'medium'); 
		$featured_img_hi = wp_get_attachment_image_src( $img['id'],'full');
		?>
		<div class="embed-responsive embed-responsive-1by1">
			<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $featured_img_hi[0]; ?>); ">
			</div>
		</div>
	</div>
	<div class="col-md-7 pt-md-2 pl-md-0">
		<h3 class="section-title font-gilroyeb"><?php echo $value[$layout_prefix.'__'.'item_title']; ?></h3>
		<?php echo $value[$layout_prefix.'__'.'item_content']; ?>
	</div>
	</div>
			<?php

		}
	?>
	
	<?php } ?>
	</div>

	</div>
<?php } ?>