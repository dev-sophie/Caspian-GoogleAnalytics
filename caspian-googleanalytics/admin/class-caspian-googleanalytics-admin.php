<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version and hooks.
 *
 * @since       1.0.0
 * @package		caspian-googleanalytics
 * @subpackage	caspian-googleanalytics/admin
 * @author		Sophie Senftleben <develop@sophie-senftleben.de>
 */
 
class Caspian_GoogleAnalytics_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var     string		$plugin_name	The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since	1.0.0
	 * @access  private
	 * @var     string		$version		The current version of this plugin.
	 */
	private $version;
	
	/**
	 * The options of this plugin.
	 *
	 * @since	1.0.0
	 * @access  private
	 * @var     string		$options		The options of this plugin.
	 */
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since	1.0.0
	 * @param   string		$plugin_name	The name of this plugin.
	 * @param   string		$version		The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		$this->set_options();

	}

	/**
	 * Adds a page link to a menu.
	 *
	 * @link	https://developer.wordpress.org/reference/functions/add_submenu_page/
	 * @since	1.0.0
	 * @return	void
	 */
	public function add_menu() {

		add_submenu_page(
			'options-general.php',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Caspian GoogleAnalytics Settings', 'caspian-googleanalytics' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Caspian GoogleAnalytics', 'caspian-googleanalytics' ) ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_settings' )
		);

	}
	
	/**
	 * Creates the settings page.
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function page_settings() {

		include( plugin_dir_path( __FILE__ ) . 'partials/caspian-googleanalytics-admin-page-settings.php' );

	}
	
	/**
	 * Sets the class variable $options.
	 *
	 * @since	1.0.0
	 * @return	void
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	}
	
}
