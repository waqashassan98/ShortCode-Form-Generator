<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.linkedin.com/in/waqas-hassan98/
 * @since             1.0.0
 * @package           Wh_optin_form
 *
 * @wordpress-plugin
 * Plugin Name:       WH Optin Form
 * Plugin URI:        https://techassle.com
 * Description:       Lead Generation Plugin, which creates a simple form based on shortcode
 * Version:           1.0.0
 * Author:            Waqas Hassan
 * Author URI:        https://www.linkedin.com/in/waqas-hassan98/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wh_optin_form
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wh_optin_form-activator.php
 */
function activate_wh_optin_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wh_optin_form-activator.php';
	Wh_optin_form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wh_optin_form-deactivator.php
 */
function deactivate_wh_optin_form() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wh_optin_form-deactivator.php';
	Wh_optin_form_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wh_optin_form' );
register_deactivation_hook( __FILE__, 'deactivate_wh_optin_form' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wh_optin_form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wh_optin_form() {

	$plugin = new Wh_optin_form();
	$plugin->run();

}
run_wh_optin_form();
