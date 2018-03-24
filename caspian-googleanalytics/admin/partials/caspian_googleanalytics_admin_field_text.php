<?php
/**
 * Provides the markup for any text field
 *
 * @since       1.0.0
 * @package		caspian-googleanalytics
 * @subpackage	caspian-googleanalytics/admin
 * @author		Sophie Senftleben <develop@sophie-senftleben.de>
 */

error_log('[Start] ' . basename(__FILE__) . ' -- ' . __METHOD__);
 
if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'caspian-googleanalytics' ); ?>: </label><?php

}
?>

<input
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>"
	type="<?php echo esc_attr( $atts['type'] ); ?>"
	value="<?php echo esc_attr( $atts['value'] ); ?>" /><?php

if ( ! empty( $atts['description'] ) ) {

	?><span class="description"><?php esc_html_e( $atts['description'], 'caspian-googleanalytics' ); ?></span><?php

}
