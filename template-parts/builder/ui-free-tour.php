<?php 
/*

	$post_id passed
	$layout_count passed

*/ 

$layout_prefix = 'ui-free-tour'; 

$section = WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id);  

// _print_code($section);

if(empty($section['section_visible'])){
	$style = '';
	$section_background_image = $section['section_background_image'];
	if(!empty($section_background_image)){
		$style = 'background-image: url([WPBC_get_attachment_image_src id='. $section_background_image['id'] .']);';
	}
?>
<div id="<?php echo $section['section_id']; ?>" class="image-cover gpy-2 gpt-md-4 gpb-md-2 bg-<?php echo $section['section_style_background']; ?> text-<?php echo $section['section_style_color']; ?>" style="<?php echo $style; ?>">

	<?php if(!empty( $section['section_title'] )){ ?>
	<div class="container" data-is-inview="detect">
		<div class="row">
			<div class="col-md-10 mx-auto text-center">
				<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
					<h2 class="section-title md font-gilroyeb mb-1"><?php echo $section['section_title']; ?></h2>
				</div>
				<?php if(!empty( $section['section_subtitle'] )){ ?>
					<div data-is-inview-fx="fadeInUp" data-transition-delay=".6s">
						<h2 class="section-title sm font-gilroysb"><?php echo $section['section_subtitle']; ?></h2>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php 
		WPBC_get_template_part('parts/free-tour-slider', array( ));
  ?>

	</div>
<?php } ?>