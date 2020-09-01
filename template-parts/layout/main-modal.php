<!--Start normal modal-->
<?php

	$modal_args = array(

		'class' => 'fade',
		'aria-hidden' => 'true',

		//'modal-title' => 'Main modal',
		//'modal-close' => '',

		'modal-dialog' => array(
			'class' => '', // modal-dialog-centered // modal-lg // modal-sm
		),
		'modal-content' => array(
			'class' => '',
			'before' => '',
			'after' => '',
		),
		'modal-header' => array(
			'class' => '', 
		),
		'modal-body' => array(
			'content' => 'Modal content.'
		),
		'modal-footer' => array( 
			'content' => '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
		),

	);

	
	$modal_args['id'] = 'main-modal'; // Prevent to change ID from filter
	WPBC_get_component('modal', $modal_args);

	/*
	Adding modals..
	*/
?>

<div id="modal_empty_cart_redirecting" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center text-primary">
        
        <p class="gpt-1 gmb-0">Los datos de tu pedido estan siendo borrados.</p> 
				<p>Redirigiendo a Mi Cuenta...</p>  
      
      </div>
    </div>
  </div>
</div>

<div id="modal-free-tour" class="modal fade " tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-fullX modal-lg" role="document">
    <div class="modal-content">
    	<div class="modal-header p-0">
    		<h2 class="modal-title text-primary section-title sm px-3 pt-3 pb-3"></h2>
				<button type="button" class="close z-index-10" data-dismiss="modal"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body text-center text-primary p-0">
      	<div class="embed-responsiveX embed-responsive-16by9X">
	        <div class="embed-responsive-itemX image-cover" style="background-image: url( ); ">
						<video oncontextmenu="return false;" controls controlsList="nodownload" class="d-block w-100" poster="<?php echo get_stylesheet_directory_uri(); ?>/images/theme/trans.png">
						</video>
					</div>
				</div>
      </div>
    </div>
  </div>
</div>