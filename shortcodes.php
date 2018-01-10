<?php
/*
Plugin Name: TruckingIndia Theme Core
Plugin URI: https://quadnotion.com/
Description: Shortcode collection Plugin devloped by Quadnotion to use with King Composer page builder.
Author: Quadnotion
Author URI: https://quadnotion.com/
Version: 1.0
*/





if ( ! defined( 'ABSPATH' ) ) exit;

if(!function_exists('is_plugin_active')){
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}


/*Include Meta option and other files here*/



/*-- ends --*/



/*Functions associated to KingComposer*/

//add a css that works for admin side. Which menas workd on the KC editor page
function truckindia_shortcode_icon() {

    wp_enqueue_style('truckindia_shortcode_icon_css', plugins_url( 'css/icon.css' , __FILE__ ) );
    wp_enqueue_style('truckindia_shortcode_admin_css', plugins_url( 'css/admin.css' , __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'truckindia_shortcode_icon' );



/* Include Other Shortcode Blocks */
if ( is_plugin_active( 'kingcomposer/kingcomposer.php' ) ){


    /*Do not use one file per shortcode, combine them to one file based on thbeir type*/

}

// Check If King Composer is activate
function truckindia_user_required_plugin() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'kingcomposer/kingcomposer.php' ) ) {
        add_action( 'admin_notices', 'truckindia_user_required_plugin_notice' );

        deactivate_plugins( plugin_basename( __FILE__ ) );

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }

}
add_action( 'admin_init', 'truckindia_user_required_plugin' );

function truckindia_user_required_plugin_notice(){
    ?><div class="error"><p>Error! you need to install or activate the <a href="https://wordpress.org/plugins/kingcomposer/">King Composer</a> plugin to run this plugin.</p></div><?php
}