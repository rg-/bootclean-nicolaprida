<?php

/*

	Set custom login screen

*/

add_filter('WPBC_set_default_option__'.'bc-options--admin-login--enable',function($option, $k){
	$option['std'] = '1';
	return $option;
}, 10, 2);

add_filter('WPBC_set_default_option__'.'bc-options--admin-login--brand-logo',function($option, $k){ 
	$option['std'] = CHILD_THEME_URI.'/images/theme/logo-nico-laprida-white.png'; 
	return $option;
}, 10, 2);
add_filter('WPBC_set_default_option__'.'bc-options--admin-login--brand-logo-width',function($option, $k){
	$option['std'] = 100; 
	return $option;
}, 10, 2);
add_filter('WPBC_set_default_option__'.'bc-options--admin-login--brand-logo-height',function($option, $k){
	$option['std'] = ''; 
	return $option;
}, 10, 2);

add_filter('WPBC_set_default_option__'.'bc-options--admin-login--body-background',function($option, $k){
	$option['std']['color'] = '#000';
	return $option;
}, 10, 2);


add_filter('WPBC_set_default_option__'.'bc-options--admin-login--custom-css',function($option, $k){
	$option['std'] = '.login label{ color:#f2f3f3; }';
	$option['std'] .= '.login h1 a{background-size:100px auto!important; width: 100px; height:91.64px;}';
	$option['std'] .= 'form{background:#000!important; color:#f2f3f3; } form button{}';
	$option['std'] .= '.wp-core-ui .button-primary{ box-shadow:none; text-shadow:none; background:#f2f3f3; color:#000; border-color:#f2f3f3;  }';
	return $option;
}, 10, 2);


add_filter('WPBC_set_default_option__'.'bc-options--admin-login--body-text-color',function($option, $k){
	//$option['std'] = '#ffffff';
	return $option;
}, 10, 2);

add_filter('WPBC_set_default_option__'.'bc-options--admin-login--body-text-color-hover',function($option, $k){
	//$option['std'] = '#ffffff';
	return $option;
}, 10, 2);


/*

	bc-options--admin-under-construction-html
	bc-options--admin-under-construction-style
	bc-options--admin-under-construction-script

*/

add_filter('WPBC_set_default_option__'.'bc-options--admin-under-construction-html',function($option, $k){
	$option['std'] = '<table><tr><td><img src="' . CHILD_THEME_URI.'/images/theme/logo-nico-laprida-white.png' . '" alt="Nico Laprida" width="100" height="91.64"/></td></tr></table>';
	return $option;
}, 10, 2);
add_filter('WPBC_set_default_option__'.'bc-options--admin-under-construction-style',function($option, $k){
	$option['std'] = 'html{height:100%;}body{background:#222; padding:0; margin:0; height:100%;} table{width:100%; height:100%; padding:0;} table tr{height:100%;} table td{height:100%; vertical-align:middle; text-align:center; }';
	return $option;
}, 10, 2);