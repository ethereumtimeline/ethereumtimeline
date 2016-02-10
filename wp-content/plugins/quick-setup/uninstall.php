<?php

/**
 * Copyright 2013 Go Daddy Operating Company, LLC. All Rights Reserved.
 */

// Make sure it's wordpress
if ( !defined( 'ABSPATH' ) && !defined( 'WP_UNINSTALL_PLUGIN' ) )
	die( 'Forbidden' );

// Delete the options we created
delete_option( 'gd_quicksetup_version' );
delete_option( 'gd_quicksetup_wizard_complete' );
delete_option( 'gd_quicksetup_last_post' );
delete_transient( 'gd_quicksetup_doing_done_install' );
delete_transient( 'gd_quicksetup_last_api_response' );

// Remove dismissed pointers from usermeta
$user_ids = $GLOBALS['wpdb']->get_results( "SELECT user_id from {$GLOBALS['wpdb']->usermeta} WHERE meta_key LIKE 'dismissed_wp_pointers' AND meta_value LIKE  '%gd-quicksetup%'" );
foreach ( (array) $user_ids as $user_id ) {
	$dismissed = explode( ',', (string) get_user_meta( $user_id, 'dismissed_wp_pointers', true ) );
	$idx = array_search( 'gd-quicksetup-start-wizard', $dismissed, true );
	unset( $dismissed[$idx] );
	$idx = array_search( 'gd-quicksetup-wizard-complete', $dismissed, true );
	unset( $dismissed[$idx] );
	update_user_meta( $user_id, 'dismissed_wp_pointers', implode( ',', $dismissed ) );
}
