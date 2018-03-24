<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sophie-senftleben.de/
 * @since      1.0.0
 *
 * @package    Caspian_Googleanalytics
 * @subpackage Caspian_Googleanalytics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Caspian_Googleanalytics
 * @subpackage Caspian_Googleanalytics/admin
 * @author     Sophie Senftleben <develop@sophie-senftleben.de>
 */
class Caspian_Googleanalytics_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->option_name = str_replace( '-', '_', $plugin_name );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Caspian_Googleanalytics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Caspian_Googleanalytics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/caspian-googleanalytics-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Caspian_Googleanalytics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Caspian_Googleanalytics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/caspian-googleanalytics-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu.
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Caspian GoogleAnalytics', 'caspian-googleanalytics' ),
			__( 'Caspian GoogleAnalytics', 'caspian-googleanalytics' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}
	
	/**
	 * Render the options page for plugin.
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		
		// check user capabilities
		if (!current_user_can('manage_options')) {
			return;
		}
		
		include_once 'partials/caspian-googleanalytics-admin-page-settings.php';
		
	}
	
	public function register_setting() {
	
		// Add a settings section
		add_settings_section(
			$this->option_name . '_settings',
			__( 'Settings', 'caspian-googleanalytics' ),
			array( $this, $this->option_name . '_settings_section' ),
			$this->plugin_name
		);
		
		add_settings_field(
			$this->option_name . '_tracking_id',
			__( 'Tracking-ID', 'caspian-googleanalytics' ),
			array( $this, $this->option_name . '_tracking_id_setting' ),
			$this->plugin_name,
			$this->option_name . '_settings',
			array( 'label_for' => $this->option_name . '_tracking_id' )
		);

		add_settings_field(
			$this->option_name . '_anonymize_ip',
			__( 'Anonymize IP', 'caspian-googleanalytics' ),
			array( $this, $this->option_name . '_anonymize_ip_setting' ),
			$this->plugin_name,
			$this->option_name . '_settings',
			array( 'label_for' => $this->option_name . '_anonymize_ip' )
		);
		
		register_setting( $this->plugin_name, $this->option_name . '_tracking_id', 'sanitize_text_field' );
		register_setting( $this->plugin_name, $this->option_name . '_anonymize_ip', array( $this, $this->option_name . '_sanitize_anonymize_ip' ) );
		
	}
	
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function caspian_googleanalytics_settings_section() {
		
		echo '<p>' . __( 'Please change the settings to match your GoogleAnalytics account.', 'caspian-googleanalytics' ) . '</p>';
		
		// echo var_dump(get_option( $this->option_name . '_tracking_id' ));
		// echo var_dump(get_option( $this->option_name . '_anonymize_ip' ));
		
	}
	
	/**
	 * Render the radio input field for position option
	 *
	 * @since  1.0.0
	 */
	public function caspian_googleanalytics_tracking_id_setting() {
		
		$tracking_id = get_option( $this->option_name . '_tracking_id' );
		echo '<input type="text" name="' . $this->option_name . '_tracking_id' . '" id="' . $this->option_name . '_tracking_id' . '" value="' . $tracking_id . '" placeholder="UA-XXXXXXXXX-X">';
	}
	
	/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function caspian_googleanalytics_anonymize_ip_setting() {
		
		$anonymize_ip = get_option( $this->option_name . '_anonymize_ip' );
		$checked = checked( 1, $anonymize_ip, false );
		echo '<input type="checkbox" name="' . $this->option_name . '_anonymize_ip" id="' . $this->option_name . '_anonymize_ip" ' . $checked . ' value="1">';
		
	}
	
	/**
	 * Sanitize the text position value before being saved to database
	 *
	 * @param  string $position $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function caspian_googleanalytics_sanitize_anonymize_ip( $input ) {
		
		//returns true if checkbox is checked
        return ( isset( $input ) ? true : false );
		
	}
	
}
