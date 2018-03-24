<?php
/**
 * Provide a admin area view for the plugin.
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since       1.0.0
 * @package		caspian-googleanalytics
 * @subpackage	caspian-googleanalytics/includes
 * @author		Sophie Senftleben <develop@sophie-senftleben.de>
 */
 
error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<form action="options.php" method="post">
		<?php
		// Output fields for the registered setting 'caspian-googleanalytics-settings'.
		settings_fields( $this->plugin_name . '-settings' );
		
		// Output setting sections and their fields.
		do_settings_sections( $this->plugin_name );

		// Output save settings button.
		submit_button( 'Änderungen speichern' );
		?>
	</form>
</div>
