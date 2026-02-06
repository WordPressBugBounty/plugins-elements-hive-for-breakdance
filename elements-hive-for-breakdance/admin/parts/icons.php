<?php

namespace ElementsHiveForBreakdance\Admin\Parts\Icons;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Icons for admin pages
 */

const EH_ADMIN_ICONS = [
	'info' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>',
];



/**
 * Render icon
 *
 * @param string $icon Icon name.
 * @param string $classes Classes for the icon.
 * @return string
 */
function render_icon( $icon, $classes = '' ) {
	if ( empty( $icon ) ) {
		return '';
	}
	$classes = 'eh-adm-icon ' . $classes;
	if ( isset( EH_ADMIN_ICONS[ $icon ] ) ) {
		?><div class="<?php echo esc_attr( $classes ); ?>"><?php echo EH_ADMIN_ICONS[ $icon ]; ?></div><?php

	}
}
