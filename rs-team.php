<?php

/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://rsteam.codesless.com
 * @since             1.0.0
 * @package           Rs_Team
 *
 * @wordpress-plugin
 * Plugin Name:       WP Rs Team
 * Plugin URI:        http://rsteam.codesless.com
 * Description:       Fully Responsive Team plugin with grid, list and slider layout.
 * Version:           1.0.0
 * Author:            Codesless
 * Author URI:        http://codesless.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rs-team
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rs-team-activator.php
 */
function activate_rs_team() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-team-activator.php';
	Rs_Team_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rs-team-deactivator.php
 */
function deactivate_rs_team() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-team-deactivator.php';
	Rs_Team_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rs_team' );
register_deactivation_hook( __FILE__, 'deactivate_rs_team' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rs-team.php';
require plugin_dir_path( __FILE__ ) . 'includes/rs-team-post-type.php';
require plugin_dir_path( __FILE__ ) . 'views/settings.php';
require plugin_dir_path( __FILE__ ) . 'views/template.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rs_team() {

	$plugin = new Rs_Team();
	$plugin->run();

}
run_rs_team();
