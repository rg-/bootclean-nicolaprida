<?php 
/*

	$post_id passed
	$layout_count passed

*/ 

$layout_prefix = 'ui-headline'; 

$section = WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id);  

// _print_code($section);

if(empty($section['section_visible'])){
	$style = '';
	$section_background_image = $section['section_background_image'];
	if(!empty($section_background_image)){
		$style = 'background-image: url([WPBC_get_attachment_image_src id='. $section_background_image['id'] .']);';
	}
?>
<div id="<?php echo $section['section_id']; ?>" class="image-cover gpy-3 gpy-md-6 bg-<?php echo $section['section_style_background']; ?> text-<?php echo $section['section_style_color']; ?>" style="<?php echo $style; ?>">

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

	<?php
	$content = get_sub_field('field_'.$layout_prefix.'__'.'content', $post_id);
	if(!empty($content)){
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto text-center">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
	<?php } ?>

	</div>
<?php } ?>