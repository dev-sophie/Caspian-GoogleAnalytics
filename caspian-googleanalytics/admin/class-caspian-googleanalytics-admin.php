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
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		$this->set_options();

	}
	
	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_styles() {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/' . $this->plugin_name . '-admin.css', array(), $this->version, 'all' );

	}
	
	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since 		1.0.0
	 */
	public function enqueue_scripts() {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		return;

	}

	/**
	 * Adds a page link to a menu.
	 *
	 * @link	https://developer.wordpress.org/reference/functions/add_submenu_page/
	 * @since	1.0.0
	 * @return	void
	 */
	public function add_menus() {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		add_options_page(
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Caspian GoogleAnalytics', 'caspian-googleanalytics' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Caspian GoogleAnalytics', 'caspian-googleanalytics' ) ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'settings_page' )
		);

	}
	
	/**
	 * Creates the settings page.
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function settings_page() {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		// check user capabilities
		if (!current_user_can('manage_options')) {
			return;
		}
		
		include( plugin_dir_path( __FILE__ ) . 'partials/caspian-googleanalytics-admin-page-settings.php' );

	}
	
	/**
	 * Creates a checkbox field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_checkbox( $args ) {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		$defaults['class'] 			= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-settings[' . $args['id'] . ']';
		$defaults['value'] 			= 0;

		apply_filters( $this->plugin_name . '-field-checkbox-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-checkbox.php' );

	}
	
	/**
	 * Creates a text field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_text( $args ) {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		$defaults['class'] 			= 'text widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-settings[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );

		$atts = wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-text.php' );

	}
	
	/**
	 * Registers settings fields with WordPress
	 */
	public function register_fields() {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		add_settings_field(
			'message-no-openings',
			apply_filters( $this->plugin_name . 'label-message-no-openings', esc_html__( 'No Openings Message', 'now-hiring' ) ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'This message displays on the page if no job postings are found.',
				'id' 			=> 'message-no-openings',
				'value' 		=> 'Thank you for your interest! There are no job openings at this time.',
			)
		);
		
		add_settings_field(
			'checkbox-no-openings',
			apply_filters( $this->plugin_name . 'label-mesage-no-openings', esc_html__( 'No Openings Message', 'now-hiring' ) ),
			array( $this, 'field_checkbox' ),
			$this->plugin_name,
			$this->plugin_name . '-messages',
			array(
				'description' 	=> 'This message displays on the page if no job postings are found.',
				'id' 			=> 'mesage-no-openings',
				'value' 		=> 'Thank you for your interest! There are no job openings at this time.',
			)
		);

	}
	
	/**
	 * Registers plugin settings.
	 *
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function register_settings() {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		register_setting(
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings'
		);

	}
	
	/**
	 * Sets the class variable $options.
	 *
	 * @since	1.0.0
	 * @return	void
	 */
	private function set_options() {
		
		error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
		
		$this->options = get_option( $this->plugin_name . '-options' );

	}
	
}
