<?php 
	$row_args = wpbc_get_template_part_row_args($args);
 	$bg_img = '';
	if(!empty($row_args['bg-image'])){
		$img_med = wp_get_attachment_image_src($row_args['bg-image'], 'medium', false );
		$img_full = wp_get_attachment_image_src($row_args['bg-image'], 'full', false ); 
		$bg_img = $img_full[0];
	} 
?>

<div id="biografia" class="bg-primary text-white">

	<div class="wpbc-full-aside-cols content-left break-md">

		<div class="col-md-6 p-0 col-fullside">

			<?php 

			$content_images = array();

			if(!empty($row_args['bg-image'])){
				$content_images[] = array(
					'id'=> $row_args['bg-image'],
				);
			}

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
			
			<div class="embed-responsive embed-responsive-4by3">
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
	 
		<div class="container gpy-3">

			<div class="row">

				<div class="col-md-7 col-content">

					<h2 class="section-title md font-gilroyeb gmb-3">
					  Biografía y Experiencia
					</h2>

					<p class="m-0">Licenciado</p>
					<h3 class="section-title font-gilroyeb">Nicolás Laprida</h3>

					<div class="row">

						<div class="col-md-6">

							<ul class="list-dot"> 
								<li>Profesor Nacional de Educación Física <br>Terapista Físico <br>Licenciado en Kinesiología y Fisioterapia</li>
								<li>Certificado Dynamic neuromuscular Stabilization (DNS) Escuela de Praga </li>
								<li>Certificado Functional Movement Systems <br>
									- Functional Movement Screen (FMS) <br>
									- Selective Functional Movement <br>Assesment (SFMA) <br>
									- Functional Movement Capacity (FCS) <br>
									- Y Balance Test (YBT)
								</li> 
							</ul>

						</div>

						<div class="col-md-6">

							<ul class="list-dot"> 
								<li>Certificado Método Stuart McGill</li>
								<li>Certificado Bioforce Conditioning</li>
								<li>Certificado Advance Strength <br>and Power EXOS </li>
								<li>Socio Fundador G.O.U. (Grupo Ortopédico Uruguayo) </li>
							</ul>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>