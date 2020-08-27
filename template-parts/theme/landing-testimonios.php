<div id="testimonios" class="bg-secondary text-primary gpt-3 gpb-3">

	<div class="container">

		<div class="row">

			<div class="col-12 text-right">

				<h2 class="section-title md font-gilroyeb">
				  Testimonios
				</h2>

			</div>

		</div>

	</div>

	<div class="container">

		<?php

		$testimonios = array(
			array(
				'image'=> 110,
				'title'=> 'Lucas Madrid',
				'subtitle'=> 'Pro Surfer',
				'text'=> 'El estudio biomecánico de la marcha es un método de diagnóstico que nos ayuda a estudiar el comportamiento estático y dinámico del pie y la relación con los segmentos del cuerpo humano.'
			),
			array(
				'image'=> 110,
				'title'=> 'Lucas Madrid',
				'subtitle'=> 'Pro Surfer',
				'text'=> 'El estudio biomecánico de la marcha es un método de diagnóstico que nos ayuda a estudiar el comportamiento estático y dinámico del pie y la relación con los segmentos del cuerpo humano.'
			),
			array(
				'image'=> 110,
				'title'=> 'Lucas Madrid',
				'subtitle'=> 'Pro Surfer',
				'text'=> 'El estudio biomecánico de la marcha es un método de diagnóstico que nos ayuda a estudiar el comportamiento estático y dinámico del pie y la relación con los segmentos del cuerpo humano.'
			),
		);

		$slick = array(
			'dots' => false,
			'arrows' => true, 
			'infinite' => true,
			'speed' => 600,
			'autoplay' => true,
			'autoplaySpeed' => 6200, 
		);
		$slick = json_encode($slick); 
		?>

		<div class="theme-slick-slider testimonios-slider" data-slick='<?php echo $slick; ?>'>
			<?php if(!empty($testimonios)){

				foreach ($testimonios as $key => $value) {
					$img_hi = "[WPBC_get_attachment_image_src id='".$value['image']."']";
					$img_low = "[WPBC_get_attachment_image_src id='".$value['image']."' size='medium']";
					?>
<div class="item">

	<div class="row">
		<div class="col-md-3 z-index-10">
			<div class="embed-responsive embed-responsive-1by1">
				<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $img_hi; ?>);"></div>
			</div>
		</div>
		<div class="col-md-9 gmt-2">
			<div class="bg-white gml-n-6 gpl-3">
				<div class="gpy-3 gpl-6 gpr-4">
					<h3 class="section-title sm font-gilroyeb"><?php echo $value['title']; ?></h3>
					<p class="lead"><?php echo $value['subtitle']; ?></p>
					<p><?php echo $value['text']; ?></p>
				</div>
			</div>
		</div>
	</div>

</div>
					<?php
				}

			} ?>

		</div>

	</div>

</div>