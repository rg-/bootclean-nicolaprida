<div class="gpy-3">
	<?php 
	$videos_front_page = get_videos_front_page();
	?>
	<p><a href="<?php echo get_permalink( $videos_front_page ); ?>" class="d-flex align-items-center"><span class="btn btn-light btn-more gmr-1"><i class="icon-arrow-left"></i></span> VOLVER A VIDEOS</a>
	<?php 
	$rutinas_front_page = get_rutinas_front_page();
	?></p>
	<p><a href="<?php echo get_permalink( $rutinas_front_page ); ?>" class="d-flex align-items-center"><span class="btn btn-light btn-more gmr-1"><i class="icon-arrow-left"></i></span> VOLVER A RUTINAS</a></p>
</div>