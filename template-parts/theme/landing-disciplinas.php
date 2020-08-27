<div id="disciplinas" class="bg-primary text-white gpy-4">

	<div class="container">

		<div class="row" data-is-inview="detect">

			<div class="col-10 mx-auto text-center">
				<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
					<h2 class="section-title smd font-gilroyeb gmb-2">Desarrollarás la movilidad y la fuerza de cada parte de tu cuerpo y mejorarás tu rendimiento</h2>
				</div>
			</div>

		</div>

	</div>

	<?php
	$items = array(
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
		array(
			'text' => 'Conditioning',
			'image' => 37
		),
	);

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
			<?php
			foreach ($items as $key => $value) {
				$featured_img_low = wp_get_attachment_image_src( $value['image'],'medium'); 
				$featured_img_hi = wp_get_attachment_image_src( $value['image'],'full');
				?>
<div class="item gp-1">
	<div class="embed-responsive embed-responsive-16by9">
		<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $featured_img_hi[0]; ?>); ">
			<div class="h-100 d-flex align-items-center justify-content-center">
				<h2 class="section-title sm font-gilroysb"><?php echo $value['text']; ?></h2>
			</div>
		</div>
	</div>
</div>
				<?php
			}
			?>
		</div>

	</div>

</div>