<?php 

add_theme_support( 'responsive-embeds' );
add_action('after_setup_theme', 'wpse65653_remove_formats', 100);
function wpse65653_remove_formats() {
   remove_theme_support('post-formats');
}

include('functions/textdomain.php');

include('functions/theme-options.php'); 
include('functions/theme-login.php'); 
include('functions/theme-options-page-settings.php');
//include('functions/theme-pjax.php'); 

include('functions/shortcodes.php'); 

include('functions/layout.php');
include('functions/layout-navmenus.php'); 
include('functions/layout-templates.php');

include('functions/widgets.php');

include('functions/enqueue-scripts.php');
include('functions/enqueue-fonts.php');

include('functions/components-slick.php');

include('functions/acf.php');
include('functions/acf-theme-settings.php');
include('functions/acf-blocks.php');

include('functions/acf-flexible-layouts.php');

include('functions/acf-layout__template_tabs_row.php');




include('functions/plugin-favorite-post.php');

/* ################################################################################## */
/* ################################################################################## */

/**
 * @subpackage Enable "is_inview" Addon
 */
	 
	add_filter('wpbc/filter/is_inview/installed', '__return_true',0,1);

/* ################################################################################## */

/**
 * @subpackage Enable "private_areas" addon
 */

	add_filter('wpbc/filter/private_areas/installed', '__return_true');
	// include('functions/addon-private_areas.php');

/* ################################################################################## */

/**
 * @subpackage WooCommerce
 */
 
if( class_exists( 'WooCommerce' ) ){
	include('functions/plugins-woocommerce.php');
}

/* ################################################################################## */

/* ################################################################################## */
/**
 * @subpackage Template Landing
 */
// include('functions/template-landing.php');

/* ################################################################################## */

include('functions/post_type-post.php');
include('functions/post_type-videos.php'); 


function custom_hide_admin_bar_settings()
{
?>
    <style type="text/css">
        .show-admin-bar {
            display: none;
        }
    </style>
<?php
}
function custom_disable_admin_bar()
{
    if(!current_user_can('administrator'))
    {
        add_filter( 'show_admin_bar', '__return_false' );
        add_action( 'admin_print_scripts-profile.php', 'custom_hide_admin_bar_settings' );
    }
}
add_action('init', 'custom_disable_admin_bar', 9);



/* NEW USER ROLE "PREMIUM SUBSCRIBER" */

function laprida__update_custom_roles() { 
    global $wp_roles;
        //set use_db to flase
        $wp_roles->use_db = false;
        //then add your role
        $wp_roles->add_role( 'premium_subscriber', 'Premium Subscriber', get_role('customer')->capabilities );
    if ( get_option( 'laprida_custom_roles_version' ) < 1 ) {
        
        //globalize $wp_roles
        

        // add_role( 'premium_subscriber', 'Premium Subscriber', get_role('customer')->capabilities );
        update_option( 'laprida_custom_roles_version', 1 );
    }

}
add_action( 'init', 'laprida__update_custom_roles' ); 