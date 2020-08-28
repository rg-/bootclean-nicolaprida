<?php 
	$row_args = wpbc_get_template_part_row_args($args);
 	$bg_img = '';
	if(!empty($row_args['bg-image'])){
		$img_med = wp_get_attachment_image_src($row_args['bg-image'], 'medium', false );
		$img_full = wp_get_attachment_image_src($row_args['bg-image'], 'full', false ); 
		$bg_img = $img_full[0];
	}  
?>

<div id="movement-foundations-membership" class="bg-light text-primary">

	<div class="wpbc-full-aside-cols content-left break-md">

		<div class="col-md-6 p-0 col-fullside text-right">
			<?php if($bg_img){ ?>
					<img class="wpbc-full-aside-inline-image" src="<?php echo $bg_img; ?>" alt=" "/>
				<?php } ?>
		</div>

		<div class="container">
		  <div class="row">
		    <div class="col-md-6 col-content">
		    	<div class="gpx-md-2 gpr-lg-3 gpl-lg-0 gpt-md-6 gpb-2 gpb-md-4 text-center text-md-left" data-is-inview="detect" >
						<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
							<h2 class="section-title md font-gilroyeb gmb-2">MOVEMENT FOUNDATIONS MEMBERSHIP</h2>
						</div>
						<div data-is-inview-fx="fadeInUp" data-transition-delay=".6s">
							<h2 class="section-title sm font-gilroyeb">+ 500 Videos, Rutinas y Planes de Entrenamiento exclusivos</h2>
						</div>
						<p>que te ayudarán a lograr un cuerpo saludable y a mejorar tu calidad de vida.</p>
						<p>Accediendo a nuestros planes de entrenamiento y a nuestra biblioteca de videos online comenzarás a entrenar y a moverte de manera consciente.</p>
						<p>[btn_lg_scroll href="#planes" label="Ver planes"]</p>
					</div>
		    </div>
		  </div>
		</div>

	</div>

</div>