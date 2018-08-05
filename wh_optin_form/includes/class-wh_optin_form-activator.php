<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.linkedin.com/in/waqas-hassan98/
 * @since      1.0.0
 *
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/includes
 * @author     Waqas Hassa <waqashassan98@gmail.com>
 */
class Wh_optin_form_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
			$exists = post_type_exists( 'customer' );
			if ($exists) {
				wp_die( 'This plugin is in conflict with your post type of customer' );
			}
	}

}
