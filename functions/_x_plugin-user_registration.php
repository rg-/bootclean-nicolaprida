<?php

remove_action( 'user_registration_account_navigation', 'user_registration_account_navigation' );

add_action( 'user_registration_account_navigation', 'custom_user_registration_account_navigation' );

function custom_user_registration_account_navigation(){
	echo "[WPBC_get_template name='theme/mi-cuenta-nav']";
}

add_action( 'user_registration_account_content', 'custom_user_registration_account_content' );
function custom_user_registration_account_content(){  
}