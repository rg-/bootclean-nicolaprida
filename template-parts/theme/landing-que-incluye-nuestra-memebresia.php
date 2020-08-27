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

		<div class="row gpy-2">

			<div class="col-md-6">

				<ul class="list-tick">
					<li>Programas de entrenamiento para principiantes y avanzados</li>
					<li>Programas de entrenamiento de fuerza General y Específica para distintas disciplinas deportivas</li>
					<li>Planes para mejorar la calidad de tus movimientos (sentadillas, peso muerto, etc.)</li>
					<li>Videos teóricos con la técnica paso a paso de cada ejercicio</li>
				</ul>

			</div>

			<div class="col-md-6">

				<ul class="list-tick">
					<li>Biblioteca de videos de fuerza, movilidad, estabilidad, liberación miofascial, recovery, Dynamic Neuromuscular Stabilization, etc. </li>
					<li>Autoevaluaciones funcionales</li>
					<li>Videos instructivos con métodos actuales para trabajar tus sistemas energéticos</li>

					<li class="no-icon gmt-5">
						<a href="#planes" class="btn btn-white btn-lg scroll-to">Ver Planes de Membresía</a>
					</li>

				</ul>

			</div>

		</div>

	</div>

</div>