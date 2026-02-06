<?php

namespace ElementsHiveForBreakdance\Admin\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Credit: Breakdance
 * Render notice in wp dashboard
 *
 * @param string $message The message to display.
 * @param string $type The type of notice (success, error, warning, info).
 */
function admin_notice( string $message, string $type = 'success' ): void {
	?>
	<div class="notice notice-<?php echo esc_attr( $type ); ?> is-dismissible">
		<p><?php echo esc_html( $message ); ?></p>
	</div>
	<?php
}
