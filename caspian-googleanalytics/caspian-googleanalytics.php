<?php
/*
Plugin Name:  Caspian GoogleAnalytics
Plugin URI:   https://sophie-senftleben.de/development/wordpress/caspian-googleanalytics/
Description:  This is a small plugin that inserts your GoogleAnalytics Tracking Code in the right place, simple and easy.
Version:      1.0.0
Author:       Sophie Senftleben
Author URI:   https://sophie-senftleben.de/
License:      GPLv3
License URI:  https://www.gnu.org/licenses/gpl-3.0.html/
Text Domain:  caspian-googleanalytics
Domain Path:  /languages

Caspian GoogleAnalytics is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
Caspian GoogleAnalytics is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Caspian GoogleAnalytics. If not, see https://www.gnu.org/licenses/gpl-3.0.html/.
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version, using SemVer (https://semver.org/).
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-caspian-googleanalytics-activator.php
 */
function activate_caspian_googleanalytics() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-caspian-googleanalytics-activator.php';
	Caspian_GoogleAnalytics_Activator::activate();
	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-caspian-googleanalytics-deactivator.php
 */
function deactivate_caspian_googleanalytics() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-caspian-googleanalytics-deactivator.php';
	Caspian_GoogleAnalytics_Deactivator::deactivate();
	
}

register_activation_hook( __FILE__, 'activate_caspian_googleanalytics' );
register_deactivation_hook( __FILE__, 'deactivate_caspian_googleanalytics' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-caspian-googleanalytics.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_caspian_googleanalytics() {

	$plugin = new Caspian_GoogleAnalytics();
	$plugin->run();

}
run_caspian_googleanalytics();
