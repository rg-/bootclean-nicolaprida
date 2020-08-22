<?php

/*

	$post_id passed
	$layout_count passed

*/ 

$layout_prefix = 'ui-box-full-cover'; 

$section = WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id);  

if(empty($section['section_visible'])){
?>
<div id="<?php echo $section['section_id']; ?>" class="bg-<?php echo $section['section_style_background']; ?> text-<?php echo $section['section_style_color']; ?>">

	<?php
		
		$section_content = get_sub_field('field_'.$layout_prefix.'__content', $post_id);

		$content_options = get_sub_field('field_'.$layout_prefix.'__content_options', $post_id);
		$content_options_side = $content_options[$layout_prefix.'__content_options_side']; 

		$content_side = $content_options_side;
		if($content_side == 'right'){
			$content_class = 'gpx-2 gpr-lg-0 gpl-lg-3 gpt-6 gpb-4 text-center text-md-left';
		}
		if($content_side == 'left'){
			$content_class = 'gpx-2 gpr-lg-3 gpl-lg-0 gpt-6 gpb-4 text-center text-md-left';
		}

		$content_images = get_sub_field('field_'.$layout_prefix.'__content_images', $post_id);
	?>

	<div class="wpbc-full-aside-cols content-<?php echo $content_side; ?> break-md">

		<div class="col-md-6 p-0 col-fullside">

			<?php 
			if(!empty($content_images)){

				$slick = array(
					'dots' => false,
					'arrows' => false, 
					'infinite' => true,
					'speed' => 600,
					'autoplay' => true,
					'autoplaySpeed' => 6200, 
				);
				$slick = json_encode($slick); 

			?>
			
			<div class="embed-responsive embed-responsive-21by9">
				<div class="embed-responsive-item">

					<div class="theme-slick-slider type-background" data-slick='<?php echo $slick; ?>'>
						<?php foreach($content_images as $k=>$v){  
							$id = $v['id'];
							?>
							<div class="item"> 
									<?php 
									$img_hi = "[WPBC_get_attachment_image_src id='".$id."']";
									$img_low = "[WPBC_get_attachment_image_src id='".$id."' size='medium']";
									?>
									<div class="item-container image-cover" data-lazybackground-src="<?php echo $img_hi; ?>" style="background-image: url(<?php echo $img_low; ?>);">
									</div>
							</div>
							<?php } ?>
					</div>
	 
				</div>
			</div>

			<?php } ?>

		</div>

		<div class="container">
		  <div class="row">
		    <div class="col-md-6 col-content">
		    	
		    	<div class="<?php echo $content_class; ?>" data-is-inview="detect">

		    		<?php if(!empty( $section['section_title'] )){ ?>
			    		<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
								<h2 class="section-title md font-gilroyeb gmb-2"><?php echo $section['section_title']; ?></h2>
							</div>
							<?php if(!empty( $section['section_subtitle'] )){ ?>
								<div data-is-inview-fx="fadeInUp" data-transition-delay=".6s">
									<h2 class="section-title sm font-gilroyeb"><?php echo $section['section_subtitle']; ?></h2>
								</div>
							<?php } ?>
						<?php } ?>

						<?php echo $section_content; ?>

		    	</div>

		    </div>
		  </div>
		</div>

	</div>

</div>
<?php
}