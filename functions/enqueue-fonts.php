<?php

add_action('wp_head', 'custom_wp_head_styles', 0); 
function custom_wp_head_styles() {
	$theme_uri = CHILD_THEME_URI.'/fonts/theme/';
 	echo "<style>

		@font-face {
		    font-family: 'gilroyeb';
		    src: url('".$theme_uri."gilroy-extrabold.eot');
		    src: url('".$theme_uri."gilroy-extrabold.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."gilroy-extrabold.woff2') format('woff2'),
		         url('".$theme_uri."gilroy-extrabold.woff') format('woff'),
		         url('".$theme_uri."gilroy-extrabold.ttf') format('truetype'),
		         url('".$theme_uri."gilroy-extrabold.svg#gilroyeb') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}
		body{
			font-family: 'gilroyl', helvetica, arial, sans-serif;
    	letter-spacing: .3px;
		}

		@font-face {
		  font-family: 'gilroysb';
		  src: url('".$theme_uri."Gilroy-SemiBold.eot?#iefix') format('embedded-opentype'), 
		  		 url('".$theme_uri."Gilroy-SemiBold.woff') format('woff'), 
		  		 url('".$theme_uri."Gilroy-SemiBold.ttf')  format('truetype'), 
		  		 url('".$theme_uri."Gilroy-SemiBold.svg#Gilroy-SemiBold') format('svg');
		  font-weight: normal;
		  font-style: normal;
		}

		@font-face {
		    font-family: 'gilroyl';
		    src: url('".$theme_uri."gilroy-light.eot');
		    src: url('".$theme_uri."gilroy-light.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."gilroy-light.woff2') format('woff2'),
		         url('".$theme_uri."gilroy-light.woff') format('woff'),
		         url('".$theme_uri."gilroy-light.ttf') format('truetype'),
		         url('".$theme_uri."gilroy-light.svg#gilroyl') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}

		@font-face {
	    font-family: 'gilroy';
	    src: url('".$theme_uri."Gilroy-Medium.eot');
	    src: url('".$theme_uri."Gilroy-Medium.eot?#iefix') format('embedded-opentype'),
	        url('".$theme_uri."Gilroy-Medium.woff2') format('woff2'),
	        url('".$theme_uri."Gilroy-Medium.woff') format('woff'),
	        url('".$theme_uri."Gilroy-Medium.ttf') format('truetype');
	    font-weight: 500;
	    font-style: normal;
	}

		@font-face {
		    font-family: 'gothamm';
		    src: url('".$theme_uri."Gotham-Medium.eot');
		    src: url('".$theme_uri."Gotham-Medium.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."Gotham-Medium.woff') format('woff'),
		         url('".$theme_uri."Gotham-Medium.ttf') format('truetype'),
		         url('".$theme_uri."Gotham-Medium.svg#gothamm') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}


		@font-face {
		    font-family: 'gothamb';
		    src: url('".$theme_uri."Gotham-book.eot');
		    src: url('".$theme_uri."Gotham-book.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."Gotham-book.woff') format('woff'),
		         url('".$theme_uri."Gotham-book.ttf') format('truetype'),
		         url('".$theme_uri."Gotham-book.svg#gothamb') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}

		@font-face {
		    font-family: 'gothambo';
		    src: url('".$theme_uri."Gotham-bold.eot');
		    src: url('".$theme_uri."Gotham-bold.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."Gotham-bold.woff') format('woff'),
		         url('".$theme_uri."Gotham-bold.ttf') format('truetype'),
		         url('".$theme_uri."Gotham-bold.svg#gothambo') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}

		@font-face {
		    font-family: 'gothaml';
		    src: url('".$theme_uri."Gotham-light.eot');
		    src: url('".$theme_uri."Gotham-light.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."Gotham-light.woff') format('woff'),
		         url('".$theme_uri."Gotham-light.ttf') format('truetype'),
		         url('".$theme_uri."Gotham-light.svg#gothaml') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}
 	</style>";
}

add_filter('BC_enqueue_scripts__fonts', 'bc_child_enqueue_custom_font_awesome'); 
function bc_child_enqueue_custom_font_awesome($fonts){ 
	$fonts['fontawesome-all'] = array( 
		'src'=>'css/fontawesome/all.min.css'
	); 
	return $fonts; 
}