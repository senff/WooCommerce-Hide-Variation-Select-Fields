<?php
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit;
	if ( get_option( 'woo_hvsf_options' ) != false ) {
		delete_option( 'woo_hvsf_options' );
	}
?>
