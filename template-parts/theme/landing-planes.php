<!-- #planes -->
<div id="planes" class="image-cover gpy-2 gpy-md-6" style="background-image: url([WPBC_get_attachment_image_src id=34]); ">

	<div class="container">

		<div class="row">

			<div class="col-12 text-center">

				<h2 class="section-title md font-gilroyeb text-white">Seleccioná un tipo de acceso</h2>

			</div>

		</div>

	</div>

	<div class="container gpb-1 gpt-md-4 gpb-md-2">
		<div class="row">
			<div class="col-xl-10 mx-auto">
				<div class="row row-half-gutters">

<?php 

$m_mensual = wc_get_product( 99 );
$m_semestral = wc_get_product( 100 );
$m_anual = wc_get_product( 101 );

$membresias = array(
	array(
		'product' => $m_mensual
	),
	array(
		'product' => $m_semestral,
		'featured' => true
	),
	array(
		'product' => $m_anual
	), 
);

foreach ($membresias as $key => $value) {
	$product = $value['product'];
	$class = 'bg-light gmt-1 gmb-1 gmt-lg-2 gmb-lg-1';
	if(!empty($value['featured'])){
		$class = 'bg-white gmt-1 gmb-1 gpb-lg-3';
	}
	?>
	<div class="col-lg-4">

		<div class="ui-plan-box text-primary gp-2 text-center <?php echo $class; ?>">

			<div class="ui-plan-head">
				<?php if(!empty($value['featured'])){ ?>
					<h2 class="ui-featured-title font-gilroyeb">¡PACK IDEAL!</h2>
				<?php } ?>
				<h2 class="ui-plan-title">
					<small class="title-desc">MEMBRESÍA</small>
					<span class="title-name font-gilroyeb"><?php echo $product->get_name(); ?></span>
				</h2>
			</div>

			<div class="ui-plan-precio">
				<?php if ( $price_html = $product->get_price() ) : ?>
					<span class="price font-gilroyeb"><?php echo wc_price($price_html); ?></span>
				<?php endif; ?>
			</div>

			<div class="ui-plan-content">
				<p>
					<?php  
					if($product->is_on_sale()){
						echo '<s>'.wc_price($product->get_regular_price()).'</s>'; 
						if(!empty(WPBC_get_field('woo_single_product_discount_desc', $product->get_id()))){
							echo '<span class="d-none d-xl-inline-block">&nbsp;-&nbsp;</span><br class="d-xl-none">'.WPBC_get_field('woo_single_product_discount_desc', $product->get_id());
						}
					}else{
						echo '&nbsp;<br class="d-xl-none"><span class="d-xl-none">&nbsp;</span>'; 
					}
					?>
				</p>
				<?php 
				$args = array(); 
				echo apply_filters(
					'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
					sprintf(
						'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
						esc_attr( isset( $args['class'] ) ? $args['class'] : 'btn btn-primary btn-lg' ),
						isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
						'Comprar'
					),
					$product,
					$args
				); ?>
				<p class="mb-0 gmt-1">
					<?php echo WPBC_get_field('woo_single_product_desc', $product->get_id()); ?>
				</p>

			</div>

		</div>
		
	</div>

	<?php } ?>

				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto text-center">
				<p class="lead"><span class="font-gilroyeb">Podés pagar con Marcado Pago, Paypal o Transferencia Bancaria*</span> <br><em class="small">* Método de pago válido para Uruguay y Argentina</em></p>
			</div>
		</div>
	</div>
 
</div>
<!-- #planes END -->