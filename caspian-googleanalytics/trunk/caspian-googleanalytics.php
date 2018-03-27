<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sophie-senftleben.de/
 * @since             1.0.0
 * @package           Caspian_Googleanalytics
 *
 * @wordpress-plugin
 * Plugin Name:       Caspian GoogleAnalytics
 * Plugin URI:        https://sophie-senftleben.de/development/wordpress/caspian-googleanalytics/
 * Description:       This is a small plugin that inserts your GoogleAnalytics Tracking Code in the right place, simple and easy.
 * Version:           1.0.0
 * Author:            Sophie Senftleben
 * Author URI:        https://sophie-senftleben.de/
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html/
 * Text Domain:       caspian-googleanalytics
 * Domain Path:       /languages
 
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
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CASPIAN_GOOGLEANALYTICS_VERSION', '1.0.0' );

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
