<?php
/*
Plugin Name: No Email Address Change!
Description: A simple plugin to disable email address changes for a user account.
Author: r-a-y
Author URI: http://profiles.wordpress.org/r-a-y
*/

/**
 * Add 'readonly' to email field on "Users > Your Profile" admin page.
 */
add_action( 'show_user_profile', function() {
	if ( is_super_admin() ) {
		return;
	}

	$js = <<<JS

<script>
jQuery(function($){
	$( '#email' ).prop('readonly', true);
});
</script>

JS;

	echo $js;
} );

/**
 * Hide email address field on "Users > Your Profile" admin page.
 */
add_action( 'admin_head-profile.php', function() {
	if ( is_super_admin() ) {
		return;
	}

	echo '<style type="text/css">tr.user-email-wrap {display:none}</style>';
} );

/**
 * Add 'readonly' to email field on a user's "Settings > General" page.
 *
 * For BuddyPress.
 */
add_action( 'bp_before_member_settings_template', function() {
	if ( is_super_admin() ) {
		return;
	}

	ob_start();
}, 999999 );

add_action( 'bp_after_member_settings_template', function() {
	if ( is_super_admin() ) {
		return;
	}

	$contents = ob_get_clean();
	$contents = str_replace( 'id="email"', 'id="email" readonly', $contents );
	echo $contents;
}, -999999 );