
<div id="free-tour" class="bg-white text-primary gpt-4 gpb-2">

	<div class="container">

		<div class="row" data-is-inview="detect">

			<div class="col-10 mx-auto text-center">
				<div data-is-inview-fx="fadeInUp" data-transition-delay=".4s">
					<h2 class="section-title md font-gilroyeb mb-1">FREE TOUR</h2>
					<h3 class="section-title sm font-gilroysb">Te mostramos un poco de nuestro método</h3>
				</div>
			</div>

		</div>

	</div>

	<div class="container">

		<?php

		$slick = array(
			'dots' => false,
			'arrows' => true, 
			'infinite' => true,
			'speed' => 600,
			'autoplay' => true,
			'autoplaySpeed' => 6200,  
			'slidesToShow' => 3,
			'slidesToScroll' => 1
		);
		$slick = json_encode($slick);

		$query = array(
				'post_type' => 'video',
				'posts_per_page' => get_option('posts_per_page'),
				'paged' => $paged, 
				'order' => 'ASC',
				'orderby' => 'date', 
				'meta_query'  => array(
            array(
                'key' => 'private_area__allow_page',
                'value' => '1'
            )
        )
			);
	  $video_loop = new WP_Query($query);
	  if($video_loop->have_posts()){

	  	?>
	  	<div class="theme-slick-slider" data-slick='<?php echo $slick; ?>'>
		  	<?php
			  while ($video_loop->have_posts()) { 
		  		$video_loop->the_post();  

		  		$post_id = get_the_ID();  
				 
					$featured_img_low = get_the_post_thumbnail_url( get_the_ID(),'medium'); 
					$featured_img_hi = get_the_post_thumbnail_url( get_the_ID(),'full');

		  		?>
		  		<div class="item gp-1">
			  		<a href="<?php echo esc_url( get_permalink() ); ?>" class="d-block">
							<div class="hover_effect">
								<div class="embed-responsive embed-responsive-4by3">
									<div class="embed-responsive-item image-cover" style="background-image: url(<?php echo $featured_img_hi; ?>); ">
									</div>
								</div>
								<span class="btn btn-more"><img src="[WPBC_get_stylesheet_directory_uri]/images/theme/icon-play.png" width="60" alt=" "/></span>
							</div>
							<h6 class="gmt-1 section-title sm text-primary"><?php the_title(); ?></h6>
						</a>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>

	</div>

</div>