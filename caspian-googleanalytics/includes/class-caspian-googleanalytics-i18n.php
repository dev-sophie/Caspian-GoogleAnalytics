<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://sophie-senftleben.de/
 * @since      1.0.0
 *
 * @package    Caspian_Googleanalytics
 * @subpackage Caspian_Googleanalytics/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Caspian_Googleanalytics
 * @subpackage Caspian_Googleanalytics/includes
 * @author     Sophie Senftleben <develop@sophie-senftleben.de>
 */
class Caspian_Googleanalytics_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'caspian-googleanalytics',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
