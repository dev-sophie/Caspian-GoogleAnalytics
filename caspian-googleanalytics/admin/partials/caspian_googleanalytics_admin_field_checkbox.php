<?php
/**
 * Provides the markup for any checkbox field
 *
 * @since       1.0.0
 * @package		caspian-googleanalytics
 * @subpackage	caspian-googleanalytics/admin
 * @author		Sophie Senftleben <develop@sophie-senftleben.de>
 */

 error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
 ?>

<label for="<?php echo esc_attr( $atts['id'] ); ?>">
	<input aria-role="checkbox"
		<?php checked( 1, $atts['value'], true ); ?>
		class="<?php echo esc_attr( $atts['class'] ); ?>"
		id="<?php echo esc_attr( $atts['id'] ); ?>"
		name="<?php echo esc_attr( $atts['name'] ); ?>"
		type="checkbox"
		value="1" />
	<span class="description"><?php esc_html_e( $atts['description'], 'caspian-googleanalytics' ); ?></span>
</label>
