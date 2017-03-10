<?php
/*
Plugin Name: Allow Aria Attributes
Version: 0.0.2
Description: Allows the use of select Aria attributes when creating content in WordPress.
Author: washingtonstateuniversity, jeremyfelt
Author URI: https://web.wsu.edu/
Plugin URI: https://github.com/washingtonstateuniversity/wsuwp-plugin-allow-aria-attributes
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// The core plugin class.
require dirname( __FILE__ ) . '/includes/class-wsuwp-allow-aria-attributes.php';

add_action( 'after_setup_theme', 'WSUWP_Allow_Aria_Attributes' );
/**
 * Start things up.
 *
 * @return \WSUWP_Allow_Aria_Attributes
 */
function WSUWP_Allow_Aria_Attributes() {
	return WSUWP_Allow_Aria_Attributes::get_instance();
}
