<?php 
/*

	$post_id passed
	$layout_count passed

*/ 

$layout_prefix = 'ui-slider-testimonios'; 

$section = WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id);  

// _print_code($section);

if(empty($section['section_visible'])){
	$style = '';
	$section_background_image = $section['section_background_image'];
	if(!empty($section_background_image)){
		$style = 'background-image: url([WPBC_get_attachment_image_src id='. $section_background_image['id'] .']);';
	}
?>
<div id="<?php echo $section['section_id']; ?>" class="image-cover gpy-2 gpy-md-3 bg-<?php echo $section['section_style_background']; ?> text-<?php echo $section['section_style_color']; ?>" style="<?php echo $style; ?>">

	<?php if(!empty( $section['section_title'] )){ ?>
	<div class="container" data-is-inview="detect">
		<div class="row">
			<div class="col-12 mx-auto text-right">
				<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
					<h2 class="section-title md font-gilroyeb"><?php echo $section['section_title']; ?></h2>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

<div class="container">
	<?php
	$items = get_sub_field('field_'.$layout_prefix.'__'.'items', $post_id);
	if(!empty($items)){
  	$slick = array(
			'dots' => false,
			'arrows' => true, 
			'infinite' => true,
			'speed' => 600,
			'autoplay' => false,
			'autoplaySpeed' => 6200, 
		);
		$slick = json_encode($slick); 

		?>
<div class="theme-slick-slider testimonios-slider" data-slick='<?php echo $slick; ?>'>
	<?php foreach ($items as $key => $value) {
		# code...
		$img_hi = "[WPBC_get_attachment_image_src id='".$value[$layout_prefix.'__item_image']['id']."']";
		$img_low = "[WPBC_get_attachment_image_src id='".$value[$layout_prefix.'__item_image']['id']."' size='medium']";
		?>
<div class="item">

	<div class="row">
		<div class="ui-slider-testimonios-thumb col-4 col-md-3 z-index-10">
			<div class="embed-responsive embed-responsive-1by1">
				<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $img_hi; ?>);"></div>
			</div>
		</div>
		<div class="ui-slider-testimonios-content col-md-9 gmt-2">
			<div class="bg-white gml-md-n-6 gpl-md-3">
				<div class="gpt-3 gpb-4 gpy-md-3 gpl-2 gpr-2 gpl-md-6 gpr-md-4">
					<h3 class="section-title sm font-gilroyeb"><?php echo $value[$layout_prefix.'__item_title']; ?></h3>
					<p class="lead"><?php echo $value[$layout_prefix.'__item_desc']; ?></p>
					<p><?php echo $value[$layout_prefix.'__item_content']; ?></p>
				</div>
			</div>
		</div>
	</div>

</div>
		<?php

	} ?>
</div>
		<?php
  } ?>
</div>

	</div>
<?php } ?>