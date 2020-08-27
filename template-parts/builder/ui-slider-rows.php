<?php 
/*

	$post_id passed
	$layout_count passed

*/ 

$layout_prefix = 'ui-slider-rows'; 

$section = WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id);  

// _print_code($section);

if(empty($section['section_visible'])){
	$style = '';
	$section_background_image = $section['section_background_image'];
	if(!empty($section_background_image)){
		$style = 'background-image: url([WPBC_get_attachment_image_src id='. $section_background_image['id'] .']);';
	}
?>
<div id="<?php echo $section['section_id']; ?>" class="image-cover gpy-2 gpy-md-4 bg-<?php echo $section['section_style_background']; ?> text-<?php echo $section['section_style_color']; ?>" style="<?php echo $style; ?>">

	<?php if(!empty( $section['section_title'] )){ ?>
	<div class="container" data-is-inview="detect">
		<div class="row">
			<div class="col-md-10 mx-auto text-center">
				<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
					<h2 class="section-title smd font-gilroyeb gmb-2"><?php echo $section['section_title']; ?></h2>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php
	$items = get_sub_field('field_'.$layout_prefix.'__'.'items', $post_id);
	if(!empty($items)){

		$slick = array(
			'dots' => true,
			'arrows' => false, 
			'infinite' => true,
			'speed' => 600,
			'autoplay' => true,
			'autoplaySpeed' => 6200, 
			'rows' => 2, 
			'slidesToShow' => 4,
			'slidesToScroll' => 4
		);
		$slick = json_encode($slick); 
		?>
		<div class="container gpy-1 p-0">

			<div class="theme-slick-slider" data-slick='<?php echo $slick; ?>'>

				<?php foreach ($items as $key => $value) { 
								
					// ui-slider-rows__item_image
					// ui-slider-rows__item_label
					$featured_img_low = wp_get_attachment_image_src( $value['ui-slider-rows__item_image']['id'],'medium'); 
					$featured_img_hi = wp_get_attachment_image_src( $value['ui-slider-rows__item_image']['id'],'full');

					?>
<div class="item gp-1">
	<div class="embed-responsive embed-responsive-16by9">
		<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $featured_img_low[0]; ?>); ">
			<div class="h-100 d-flex align-items-center justify-content-center">
				<h2 class="section-title sm font-gilroysb"><?php echo $value['ui-slider-rows__item_label']; ?></h2>
			</div>
		</div>
	</div>
</div>
				<?php } ?>

			</div>

		</div>
		<?php
	?>
	
	<?php } ?>

	</div>
<?php } ?>