<?php

add_filter('BC_enqueue_scripts__version', function(){
	return '10.2.0';
},10,1);


/*

	Add inline head styles

*/

add_filter('WPBC_add_inline_style',function($css){
	/* On old days i use to put this on the project css file, but that will not work till the css is loaded. To prevent similar situations, just put inline styles on the most top of the <head> element, like this one here. */
	$css .= 'body.loading{overflow:hidden!important;}'; 
	$css .= '.no-touchevents ::-webkit-scrollbar { width: 10px; height: 10px; }';
	return $css;
},20,1);



add_action( 'wp_head', 'google_analytics_custom_code', 0 );
function google_analytics_custom_code(){
	?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90776632-1', 'auto');
  ga('send', 'pageview');

</script>
	<?php
}

/*

	@filter BC_enqueue_scripts__styles_uri

	Change styles (css) path to use parent theme ones.



add_filter( 'BC_enqueue_scripts__styles_uri', function($styles_uri){
	$styles_uri = THEME_URI; 
	return $styles_uri;
}, 10,1 ); 

*/
/**
 * Enqueue "custom" js
 */ 
function bc_child_wp_enqueue_scripts() {   
	wp_register_script( 'child-theme-customs', get_stylesheet_directory_uri() .'/js/customs.js', array('main'), null, true);
	wp_enqueue_script( 'child-theme-customs' ); 
}
add_action( 'wp_enqueue_scripts', 'bc_child_wp_enqueue_scripts',20 ); 