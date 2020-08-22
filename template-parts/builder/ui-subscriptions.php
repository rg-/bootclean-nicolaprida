<?php 
/*

	$post_id passed
	$layout_count passed

*/ 

$layout_prefix = 'ui-subscriptions'; 

$section = WPBC_acf_get_flexible_content_layout($layout_prefix, $post_id); 

if(empty($section['section_visible'])){
	$style = '';
	$section_background_image = $section['section_background_image'];
	if(!empty($section_background_image)){
		$style = 'background-image: url([WPBC_get_attachment_image_src id='. $section_background_image['id'] .']);';
	}
?>
<div id="<?php echo $section['section_id']; ?>" class="image-cover gpy-2 gpy-md-6 bg-<?php echo $section['section_style_background']; ?> text-<?php echo $section['section_style_color']; ?>" style="<?php echo $style; ?>">

	<?php if(!empty( $section['section_title'] )){ ?>
	<div class="container" data-is-inview="detect">
		<div class="row">
			<div class="col-12 text-center">
				<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
					<h2 class="section-title md font-gilroyeb"><?php echo $section['section_title']; ?></h2>
				</div>
				<?php if(!empty( $section['section_subtitle'] )){ ?>
					<div data-is-inview-fx="fadeInUp" data-transition-delay=".6s">
						<h2 class="section-title sm font-gilroyeb"><?php echo $section['section_subtitle']; ?></h2>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>


	<?php

	// customs for this layout

	$membresia_left_post = get_sub_field('field_'.$layout_prefix.'__'.'membresia_left_post', $post_id);
	$membresia_center_post = get_sub_field('field_'.$layout_prefix.'__'.'membresia_center_post', $post_id);
	$membresia_right_post = get_sub_field('field_'.$layout_prefix.'__'.'membresia_right_post', $post_id);
	
	if( $membresia_left_post && $membresia_center_post && $membresia_right_post ){
  
	?>
	<div class="container gpb-1 gpt-md-4 gpb-md-2">
		<div class="row">
			<div class="col-xl-10 mx-auto">
				<div class="row row-half-gutters">

<?php 

$m_mensual = wc_get_product( $membresia_left_post );
$m_semestral = wc_get_product( $membresia_center_post );
$m_anual = wc_get_product( $membresia_right_post );

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

	<?php } ?>

	<?php
	$membresia_footer_html = get_sub_field('field_'.$layout_prefix.'__'.'membresia_footer_html', $post_id);
	if(!empty($membresia_footer_html)){
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 mx-auto text-center">
				<?php echo $membresia_footer_html; ?>
			</div>
		</div>
	</div>
	<?php } ?>

</div>
<?php } ?>