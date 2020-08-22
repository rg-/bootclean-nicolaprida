<?php 

// Disable for debuggin

return;

global $post; 

if( !isset($_GET['redirect_to']) && isset($_GET['private']) && !WPBC_private_areas_if_allowed_user() && !is_user_logged_in() ){  
		$alert_args = array(
			'class' => 'bg-danger text-white',
			'heading' => _x('You are trying to access a private content','bootclean'),
			'lead' => _x('<u>Log in</u> or <u>Register</u> to gain access.','bootclean'),
			'p' => _x('Private content is allowed only for users with a <u>subscription</u> plan actived.','bootclean'),
			'dismiss' => false,
		); 
	}
	if( !WPBC_private_areas_if_bypass() && WPBC_private_areas_if_allowed_user()  ){
		if(WPBC_private_areas__if_allowed_page($post->ID)){
	 		$alert_args = array(
				'class' => 'alert-success',
				'heading' => '',
				'lead' => _x('This page has private content and you are allowed to access it. Your subscription is active.','bootclean'),
				'p' => '',
				'dismiss' => true,
			);
	 	}else{
	 		$alert_args = array(
				'class' => 'alert-success',
				'heading' => '',
				'lead' => _x('This a private content and you are allowed to access it. Your subscription is active.','bootclean'),
				'p' => '',
				'dismiss' => true,
			);
	 	}
	}

	if(is_user_logged_in() && !WPBC_private_areas_if_allowed_user()){
 		if( isset($_GET['private']) ){
	 		$alert_args = array(
				'class' => 'bg-danger text-white',
				'heading' => _x('You are trying to access a private content','bootclean'),
				'lead' => _x('An active subscription is required to access, purchase one or renew if expired.','bootclean'),
				'p' => '',
				'dismiss' => true,
			);
	 	}else{
	 		$alert_args = array(
				'class' => 'bg-danger text-white',
				'heading' => _x('You don´t have an active subscription!','bootclean'),
				'lead' => _x('An active subscription is required to access, purchase one or renew if expired.','bootclean'),
				'p' => '',
				'dismiss' => true,
			);
	 	} 
	}
	
	if( WPBC_private_areas__if_allowed_page($post->ID) && !WPBC_private_areas_if_allowed_user() ){
 		$alert_args = array(
			'class' => 'bg-danger text-white',
			'heading' => _x('This page contains some private content','bootclean'),
			'lead' => _x('An active subscription is required to view it, purchase one or renew if allready have one expired.','bootclean'),
			'p' => '',
			'dismiss' => true,
		); 
	}
?>
<?php if(!empty($alert_args)){ ?>
<div class="alert <?php echo $alert_args['class'];?>" role="alert">
  <div class="container position-relative">
		<?php if(!empty($alert_args['heading'])) { ?><h4 class="alert-heading"><?php echo $alert_args['heading'];?></h4><?php } ?>
		<?php if(!empty($alert_args['lead'])) { ?><span class="lead"><?php echo $alert_args['lead'];?></span><?php } ?>
		<?php if(!empty($alert_args['lead']) && !empty($alert_args['p'])) { ?><hr><?php } ?>
		<?php if(!empty($alert_args['p'])) { ?><p class="mb-0"><?php echo $alert_args['p'];?></p><?php } ?>
		<?php if(!empty($alert_args['dismiss'])) { ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" >
		<span aria-hidden="true">&times;</span>
		</button>
		<?php } ?>
	</div>
</div>
<?php } ?>