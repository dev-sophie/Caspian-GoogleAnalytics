<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sophie-senftleben.de/
 * @since      1.0.0
 *
 * @package    Caspian_Googleanalytics
 * @subpackage Caspian_Googleanalytics/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Caspian_Googleanalytics
 * @subpackage Caspian_Googleanalytics/public
 * @author     Sophie Senftleben <develop@sophie-senftleben.de>
 */
class Caspian_Googleanalytics_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->option_name = str_replace( '-', '_', $plugin_name );

	}
	
	public function add_googleanalytics_tracking_code() {
	
		$tracking_id = get_option( $this->option_name . '_tracking_id' );
		if (empty($tracking_id)) return;
		
		$anonymize_ip = get_option( $this->option_name . '_anonymize_ip' );
		
		?><!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_id ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', '<?php echo $tracking_id ?>');
			<?php if ($anonymize_ip == true) echo "ga('set', 'anonymizeIp', true);" ?>
		</script><?php
		
	}

}
