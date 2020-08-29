<?php

	$row_args = wpbc_get_template_part_row_args($args);
 	$bg_img = '';
	if(!empty($row_args['bg-image'])){
		$img_med = wp_get_attachment_image_src($row_args['bg-image'], 'medium', false );
		$img_full = wp_get_attachment_image_src($row_args['bg-image'], 'full', false ); 
		$bg_img = $img_full[0];
	}

	
?>
<div id="que-incluye" class="image-cover text-white bg-primary gpy-2 gpy-md-6" style="background-image:url(<?php echo $bg_img;?>);">

	<div class="container">

		<div class="row">

			<div class="col-12 text-center">

				<h2 class="section-title md font-gilroyeb">
				  ¿Qué incluye nuestra membresía?
				</h2>

			</div>

		</div>

		<div class="row gpy-md-2">

			<div class="col-md-6">

				<ul class="list-tick">
					<li><b>Programas de entrenamiento</b> para <b>principiantes y avanzados</b></li>
					<li>Programas de entrenamiento de <b>fuerza General y Específica</b> para distintas <b>disciplinas deportivas</b></li>
					<li>Planes para <b>mejorar la calidad de tus movimientos</b> (sentadillas, peso muerto, etc.)</li>
					<li>Videos teóricos con la <b>técnica paso a paso de cada ejercicio</b></li>
				</ul>

			</div>

			<div class="col-md-6">

				<ul class="list-tick">
					<li><b>Biblioteca de videos</b> de fuerza, movilidad, estabilidad, liberación miofascial, recovery, Dynamic Neuromuscular Stabilization, etc. </li>
					<li><b>Autoevaluaciones funcionales</b></li>
					<li><b>Videos instructivos</b> con métodos actuales para trabajar tus <b>sistemas energéticos</b></li>

					<li class="no-icon gmt-5">
						<a href="#planes" class="btn btn-white btn-lg scroll-to">Ver Planes de Membresía</a>
					</li>

				</ul>

			</div>

		</div>

	</div>

</div>