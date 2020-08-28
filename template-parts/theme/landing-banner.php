<?php 
	$row_args = wpbc_get_template_part_row_args($args);
 	$bg_img = '';
	if(!empty($row_args['bg-image'])){
		$img_med = wp_get_attachment_image_src($row_args['bg-image'], 'medium', false );
		$img_full = wp_get_attachment_image_src($row_args['bg-image'], 'full', false ); 
		$bg_img = $img_full[0];
	} 
?>
<div id="banner" class="bg-primary text-white image-cover gpt-4 gpb-3" style="background-image: url(<?php echo $bg_img; ?>); ">

	<div class="container">

		<div class="row align-items-center">

			<div class="col-md-6 text-center text-md-left">

				<p class="lead font-gilroysb">
				  Comenzá ya mismo a transformar tu cuerpo, mejorar tu postura, movimiento, rendimiento y tu calidad de vida.
				</p>

			</div>

			<div class="col-md-6 text-center text-md-right gpr-md-3">

				<p>
				  <a href="#planes" class="btn btn-outline-white btn-blg scroll-to">¡SUMATE AHORA!</a>
				</p>

			</div>

		</div>

	</div>

</div>