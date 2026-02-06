<?php

namespace ElementsHiveForBreakdance\Admin\Parts\LinkButton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
function render( $url, $text, $type = 'primary', $size = 'default' ) {
	$classes = 'eh-adm-link-button eh-adm-bg-accent eh-adm-text-alt eh-adm-border-none eh-adm-rounded-sm eh-adm-py-sm eh-adm-px-md eh-adm-transition-fast eh-adm-no-underline eh-adm-font-bold';
	if ( 'secondary' === $type ) {
		$classes .= ' eh-adm-link-button--secondary';
	}
	if ( 'large' === $size ) {
		$classes .= ' eh-adm-link-button--large';
	}
	?>
		<a href="<?php echo esc_url( $url ); ?>" target="_blank"  class="<?php echo esc_attr( $classes ); ?>">
			<span class="eh-adm-link-button__text"><?php echo esc_html( $text ); ?></span>
		</a>
	<?php
}

