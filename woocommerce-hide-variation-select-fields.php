<?php
/*
Plugin Name: WooCommerce Hide Variation Select Fields
Plugin URI: http://www.senff.com/plugins/woocommerce-hide-variation-select-fields
Description: [Short description]
Author: Senff
Author URI: http://www.senff.com
Version: 0.1
*/

defined('ABSPATH') or die('INSERT COIN');


/**
 * === FUNCTIONS ========================================================================================
 */


/**
 * --- IF DATABASE VALUES ARE NOT SET AT ALL, ADD DEFAULT OPTIONS TO DATABASE ---------------------------
 */
if (!function_exists('woo_hvfs_default_options')) {
	function woo_hvfs_default_options() {
		$versionNum = '0.1';
		if (get_option('woo_hvfs_options') === false) {		
			// add_option('woo_hvfs__options',$new_options);
		} 
	}
}


/**
 * --- LOAD MAIN .JS FILE AND CALL IT WITH PARAMETERS (BASED ON DATABASE VALUES) -----------------------
 */
if (!function_exists('load_woo_hvfs')) {
    function load_woo_hvfs() {

		// Main CSS file 
		wp_register_style('wooHVSFStyle', plugins_url('/assets/css/woo-hvsf.css', __FILE__) );
	    wp_enqueue_style('wooHVSFStyle');

		wp_enqueue_script('wooHVSFScript', plugins_url('/assets/js/woo-hvsf.js', __FILE__), array( 'jquery' ), '0.1', true);

    }
}



/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

$plugin = plugin_basename(__FILE__); 

register_activation_hook( __FILE__, 'woo_hvfs_default_options' );
add_action('wp_enqueue_scripts', 'load_woo_hvfs');
// add_action('admin_menu', 'simple_debug_menu');
// add_action('admin_init', 'simple_debug_admin_init' );
// add_action('admin_enqueue_scripts', 'simple_debug_styles' );
// add_filter("plugin_action_links_$plugin", 'simple_debug_settings_link' );
