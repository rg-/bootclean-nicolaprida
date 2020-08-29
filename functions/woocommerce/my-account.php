<?php

add_filter('wpbc/filter/woocommerce/config', function ($wpbc_woocommerce_config){
	
	// make .col2-set 100% width
	$class = ' col-col2-container ';
	// make .col2-set columns as bootstrap columns
	$class_cols = ' col-col2-set-1-md-12 col-col2-set-2-md-12 ';
	// make nav and content as bootstrap columns too
	$class_nav = ' col-navigation-lg-3 col-navigation-order-1 ';
	$class_content = ' col-content-lg-9 col-content-order-2 ';
	if( is_wc_endpoint_url( 'edit-address' ) || is_wc_endpoint_url( 'edit-account' ) ){ 
		$class_content = ' col-content-lg-6 col-content-order-2 ';
	}

	$class .= $class_cols.$class_nav.$class_content;

	if( is_account_page() && !is_user_logged_in() ){
		$class = '';
	}

	$wpbc_woocommerce_config['layout']['myaccount'] = array(
		'class' => $class,
	); 
	
	return $wpbc_woocommerce_config;

},10,1); 

add_filter('layout_general_body_background',function($use){
	if( is_account_page() && is_user_logged_in() ){
		$use = false;
	}
	return $use; 
},10,1);

add_action('wpbc/layout/start', function(){   
	
	if( is_account_page() ){
		remove_action('wpbc/layout/start', 'theme_custom_search_form',39);
	}

	if( is_account_page() && !is_user_logged_in() ){ 
		remove_action('wpbc/layout/start', 'WPBC_layout_struture__main_navbar',10);
	} 

},0);  

add_filter('wpbc/body/class', function($class){
	if( is_account_page() && is_user_logged_in() ){
		$class .= ' single-header ';
	}
	return $class;

},10,1 ); 

add_filter('wpbc/filter/layout/main-page-header/defaults',function($defaults){ 
	if( is_account_page() && is_user_logged_in() ){
		$template_id = get_videos_layout_header_template();  
		$defaults['template_id'] = $template_id; 
	}
	return $defaults;  
},10,1);

/* 

content-single-page.php template 

*/

add_filter('wpbc/filter/page/single/class',function($class){
	if( is_account_page() && !is_user_logged_in() ){
		$class .= 'col-md-10 col-lg-8 col-xl-6 mx-auto';
	}
	return $class;
},10,1);

add_filter('laprida/single/page/entry-content/class',function($class){
	if( is_account_page() && is_user_logged_in() ){
		$class .= ' gmt-1 gmb-1 woo-account-panels';
	}
	return $class;
},10,1);

add_filter('laprida/single/page/footer',function($use){
	if( is_account_page() ){
		$use = false;
	}
	return $use; 
},10,1);  
add_filter('laprida/single/page/actions',function($use){
	if( is_account_page() ){
		$use = false;
	}
	return $use; 
},10,1);  

add_filter('WPBC_post_header_show', function($show){
	if( is_account_page() ){
		$show = false;
	}
	return $show; 
},10,1);   


/* woo templates /myaccount*/ 

add_action('woocommerce_before_customer_login_form',function(){
	?>
	<div id="login-tabs" class="woo-account-login-tabs">
		<?php $logo = get_stylesheet_directory_uri().'/images/theme/logo-nico-laprida-white.png'; 
      echo '<img src="'.$logo.'" alt="'.get_bloginfo('title').'" class="navbar-brand-img mx-auto gmt-1 gmb-1 d-block" width="70"/>';
    ?>

		<ul class="nav d-block d-md-flex justify-content-between align-items-center" id="tab-nav">
		  <li class="nav-item">
		    <a class="btn btn-link d-block" id="acceder-tab" data-toggle="collapse-custom" href="#acceder" role="button" aria-expanded="true" data-parent="#login-tabs">Acceder</a>
		  </li>
		  <li class="nav-item gmx-1 text-secondary"><span class="d-none d-md-block">|</span><span class="d-block d-md-none text-center">- o -</span></li>
		  <li class="nav-item">
		    <a class="btn btn-link collapsed d-block" id="crear-tab" data-toggle="collapse-custom" href="#crear" role="button" aria-expanded="false" data-parent="#login-tabs">Crear tu cuenta</a>
		  </li>
		</ul>

		<div class="panel-group gmt-1 gmb-2" id="tab-content">
        

	<?php
});
add_action('woocommerce_after_customer_login_form',function(){
	?>
		</div>
	</div>
	<?php
});

add_action('woocommerce_login_form_start',function(){
	?>
	<div class="panel-collapse collapse fade show" id="acceder" data-parent="#tab-content">
	<?php
});
add_action('woocommerce_login_form_end',function(){
	?>
	</div>
	<?php
}); 

add_action('woocommerce_register_form_start',function(){
	?>
	<div class="panel-collapse collapse fade" id="crear" data-parent="#tab-content">
	<?php
});
add_action('woocommerce_register_form_end',function(){
	?>
	</div>
	<?php
});


add_action('woocommerce_before_lost_password_form',function(){
	?>
	<div id="login-tabs" class="woo-account-login-tabs gpb-2">
		<?php $logo = get_stylesheet_directory_uri().'/images/theme/logo-nico-laprida-white.png'; 
      echo '<img src="'.$logo.'" alt="'.get_bloginfo('title').'" class="navbar-brand-img mx-auto gmt-1 gmb-1 d-block" width="70"/>'; ?>
      <?php
});
add_action('woocommerce_after_lost_password_form',function(){
	?></div><?php
});

add_action('woocommerce_before_lost_password_confirmation_message',function(){
	?>
	<div id="login-tabs" class="woo-account-login-tabs gpb-2">
		<?php $logo = get_stylesheet_directory_uri().'/images/theme/logo-nico-laprida-white.png'; 
      echo '<img src="'.$logo.'" alt="'.get_bloginfo('title').'" class="navbar-brand-img mx-auto gmt-1 gmb-1 d-block" width="70"/>'; ?>
      <?php
});
add_action('woocommerce_after_lost_password_confirmation_message',function(){
	?></div><?php
});


// dashboard

add_action('woocommerce_account_dashboard', function(){
	$current_user = wp_get_current_user();
	$user_id = get_current_user_id();
	$display_name = esc_html( $current_user->display_name );
	?>
	<div class="woo-account-panel-dashboard">

		<div class="d-flex gmb-1">

			<div class="woo-account-panel-dashboard-profile_pic">
				<?php
					$gravatar_image      = get_avatar_url( get_current_user_id(), $args = null );
					$profile_picture_url = get_user_meta( get_current_user_id(), 'profile_pic', true ); 
					$profile_picture_url = wp_get_attachment_image_src($profile_picture_url);
					$image = ( ! empty( $profile_picture_url ) ) ? $profile_picture_url[0] : $gravatar_image; 
				?>
				<img width="100" class="profile-preview" alt="profile-picture" src="<?php echo $image; ?>">
			</div>

			<div class="woo-account-panel-dashboard-profile_name gpt-1 gpx-1">
				<h2 class="section-title">Hola <?php echo ' <strong>' . $display_name . '</strong>'; ?></h2>
				<p><small>¿No eres <?php echo $display_name; ?>? <a href="<?php echo esc_url( wc_logout_url() ); ?>"><u>Salir</u></a></small></p>
			</div>

		</div>

		<p class="gmb-2">Desde el tablero de tu cuenta puedes ver y administrar:</p>

		<ul>
			<li class="mb-3"><a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>">Pedidos <br><small>Ver tus órdenes y pedidos.</small></a></li>
			<li class="mb-3"><a href="<?php echo esc_url( wc_get_endpoint_url( 'subscriptions' ) ); ?>">Subscripciones <br><small>Ver el estado de tus subscripciones.</small></a></li>
			<li class="mb-3"><a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>">Direcciones <br><small>Administrar tu dirección de Facturación</small></a></li>
			<li class="mb-3"><a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-account' ) ); ?>">Detalles de la cuenta <br><small>Editar tus datos de usuario y cambiar tu contraseña.</small></a></li>
		</ul>
	</div>
	<?php

},10);


add_action( 'woocommerce_account_content', 'WPBC_woocommerce_account_content', 0 );
function WPBC_woocommerce_account_content(){

	if( is_wc_endpoint_url( 'orders' ) ){
		$text = 'Pedidos';
	} 
	if( is_wc_endpoint_url( 'edit-address' ) ){
		$text = 'Direcciones';
	}
	if( is_wc_endpoint_url( 'edit-account' ) ){
		$text = 'Detalles de la Cuenta';
	}
	if( is_wc_endpoint_url( 'view-subscription' ) ){
		$text = 'Subscripciones';
	}

	// woocommerce_breadcrumb();
	$user_id = get_current_user_id();
	$subscriptions = wcs_get_users_subscriptions($user_id); 
	foreach ($subscriptions as $sub){ 
		$end = $sub->get_date('end');
		$end_display = esc_html( $sub->get_date_to_display( 'end' ) );
		$current_time = date('Y-m-d H:i:s', time()); 
		$str_end = strtotime($end);
		$str_curr = strtotime($current_time);
		$str_dif = $str_end - $str_curr;
		if($str_dif>0 && $str_dif<6000){
			//_print_code($str_dif);
		} 
	}
	

	?>
	<?php if(!empty($text)){ ?>
		<header class="woo-myaccount-header">
				<h2 class="section-title"><?php echo $text; ?></h2>
		</header>
	<?php } ?>
	<?php
}