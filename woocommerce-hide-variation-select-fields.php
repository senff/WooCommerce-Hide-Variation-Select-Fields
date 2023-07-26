<?php
/*
Plugin Name: WooCommerce Hide Variation Select Fields
Plugin URI: https://wordpress.org/plugins/woocommerce-hide-variation-select-fields
Description: Select fields on variable products are obscured if the previous one is not selected yet.
Author: Senff
Author URI: http://www.senff.com
Version: 1.0
*/

defined('ABSPATH') or die('INSERT COIN');


/**
 * === FUNCTIONS ========================================================================================
 */


/**
 * --- IF DATABASE VALUES ARE NOT SET AT ALL, ADD DEFAULT OPTIONS TO DATABASE ---------------------------
 */
if (!function_exists('woo_hvsf_default_options')) {
	function woo_hvsf_default_options() {
		$versionNum = '1.0';
		if (get_option('woo_hvsf_options') === false) {
			$new_options['woo_hvsf_version'] = $versionNum;
			$new_options['woo_hvsf_hiddenstyle'] = '1';	
			$new_options['woo_hvsf_opacity'] = '1';	
			$new_options['woo_hvsf_blur'] = '0';	
			add_option('woo_hvsf_options',$new_options);
		} 
	}
}


/**
 * --- LOAD MAIN .JS FILE AND CALL IT  -----------------------
 */
if (!function_exists('load_woo_hvsf')) {
    function load_woo_hvsf() {

		// Main CSS file 
		wp_register_style('wooHVSFStyle', plugins_url('/assets/css/woo-hvsf.css', __FILE__) );
	    wp_enqueue_style('wooHVSFStyle');

	    // Main JS file
		wp_enqueue_script('wooHVSFScript', plugins_url('/assets/js/woo-hvsf.js', __FILE__), array( 'jquery' ), '0.1', true);

    }
}


/**
 * --- ADD TAB TO WOO SETTINGS PAGE ------------------------------------------------------------
 */

if (!function_exists('add_woo_hvsf_settings_tab')) {
	function add_woo_hvsf_settings_tab($tabs) {
	    $tabs['woo_hvsf'] = __('Hide Variation Select Fields', 'woo-hide-variation-select-fields'); 
	    return $tabs;
	}
}


/**
 * --- THE WHOLE ADMIN SETTINGS PAGE -------------------------------------------------------------------
 */

if (!function_exists('render_woo_hvsf_settings_tab')) {
	function render_woo_hvsf_settings_tab() {
		// Retrieve plugin configuration options from database
		$hvsf_options = get_option( 'woo_hvsf_options' );
		?>

		<div id="woo-hvsf-settings-general" class="wrap">
			<h1 class="screen-reader-text"><?php _e('Hide Variation Select Fields','woo-hide-variation-select-fields'); ?></h1>

			<h2><?php _e('Hide Variation Select Fields','woo-hide-variation-select-fields'); ?></h2>

			<p><?php _e('Here you can change how the SELECT fields of a Variable Product should be shown.','woo-hide-variation-select-fields'); ?></p>

			<div class="main-content">
































			</div>


	    <?php
	}
}


/**
 * --- ADD LINK TO SETTINGS PAGE TO PLUGIN ------------------------------------------------------------
 */
if (!function_exists('woo_hvsf_settings_link')) {
function woo_hvsf_settings_link($links) { 
	$settings_link = '<a href="/wp-admin/admin.php?page=wc-settings&tab=woo_hvsf_settings">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
	}
}


/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

$plugin = plugin_basename(__FILE__); 

register_activation_hook( __FILE__, 'woo_hvsf_default_options' );
add_action('wp_enqueue_scripts', 'load_woo_hvsf');
add_filter("plugin_action_links_$plugin", 'woo_hvsf_settings_link' );
add_filter('woocommerce_settings_tabs_array', 'add_woo_hvsf_settings_tab', 50);
add_action('woocommerce_settings_tabs_woo_hvsf', 'render_woo_hvsf_settings_tab');

